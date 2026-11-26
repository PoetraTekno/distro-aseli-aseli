<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DistroCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_populates_admin_categories_products_and_images(): void
    {
        Storage::fake('public');

        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', [
            'username' => 'admin',
            'name' => 'Admin Distro Aseli Aseli',
            'email' => 'admin@distroaseliaseli.com',
        ]);
        $this->assertDatabaseCount('categories', 3);
        $this->assertDatabaseCount('products', 6);

        $firstProduct = Product::with('category')->firstOrFail();
        $this->assertInstanceOf(Category::class, $firstProduct->category);
        $this->assertTrue($firstProduct->category->products->contains($firstProduct));
        Storage::disk('public')->assertExists($firstProduct->image);
    }

    public function test_public_homepage_displays_real_logo_brand_profile_catalog_and_filter(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('images/logo_distro_aseli_aseli.webp', false);
        $response->assertSee('<link rel="icon" type="image/webp"', false);
        $response->assertSee('Distro Aseli Aseli');
        $response->assertSee('Gaya Lokal, Kualitas Maksimal');
        $response->assertSee('Kaos Oversize');
        $response->assertSee('Rp 125.000');

        $filtered = $this->get('/?category=aksesoris-topi');
        $filtered->assertOk();
        $filtered->assertSee('Topi Snapback');
        $filtered->assertDontSee('Hoodie Boxy');
    }

    public function test_public_product_detail_page_displays_product_and_returns_404_for_missing_slug(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $product = Product::firstOrFail();

        $response = $this->get(route('catalog.show', $product->slug));
        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee($product->formatted_price);
        $response->assertSee('Pesan via WhatsApp');

        $this->get('/produk/slug-tidak-ada')->assertNotFound();
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_routes(): void
    {
        $this->get(route('admin.products.index'))->assertRedirect(route('login'));
        $this->get(route('admin.products.create'))->assertRedirect(route('login'));
        $this->post(route('admin.products.store'), [])->assertRedirect(route('login'));
    }

    public function test_admin_can_login_with_seeded_credentials_and_logout(): void
    {
        Storage::fake('public');
        $this->seed(DatabaseSeeder::class);

        $loginPage = $this->get(route('login'));
        $loginPage->assertOk();
        $loginPage->assertSee('images/logo_distro_aseli_aseli.webp', false);
        $loginPage->assertSee('Masuk ke Panel Admin');

        $failedLogin = $this->from(route('login'))->post(route('login.authenticate'), [
            'username' => 'admin',
            'password' => 'salah123',
        ]);
        $failedLogin->assertRedirect(route('login'));
        $failedLogin->assertSessionHasErrors('username');
        $this->assertGuest();

        $successfulLogin = $this->post(route('login.authenticate'), [
            'username' => 'admin',
            'password' => 'admin123',
        ]);
        $successfulLogin->assertRedirect(route('admin.products.index'));
        $this->assertAuthenticated();

        $adminPage = $this->get(route('admin.products.index'));
        $adminPage->assertOk();
        $adminPage->assertSee('Logout');

        $logoutResponse = $this->post(route('logout'));
        $logoutResponse->assertRedirect(route('login'));
        $this->assertGuest();

        $this->get(route('admin.products.index'))->assertRedirect(route('login'));
    }

    public function test_authenticated_admin_can_create_update_and_delete_product_with_image_lifecycle(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $category = Category::create([
            'name' => 'Kaos (T-Shirt)',
            'slug' => 'kaos-t-shirt',
        ]);

        // Create page & store
        $this->actingAs($admin)->get(route('admin.products.index'))->assertOk();
        $this->actingAs($admin)->get(route('admin.products.create'))
            ->assertOk()
            ->assertSee('Kaos (T-Shirt)');

        $firstImage = $this->fakePngUpload('kaos-baru.png');
        $storeResponse = $this->actingAs($admin)->post(route('admin.products.store'), [
            'name' => 'Kaos Streetwear "Merdeka" Hitam',
            'category_id' => $category->id,
            'price' => 150000,
            'stock' => 18,
            'description' => 'Kaos katun kombed 24s dengan sablon plastisol tahan lama.',
            'image' => $firstImage,
        ]);

        $storeResponse->assertRedirect(route('admin.products.index'));
        $storeResponse->assertSessionHas('success');

        $product = Product::where('name', 'Kaos Streetwear "Merdeka" Hitam')->firstOrFail();
        $oldImagePath = $product->image;
        Storage::disk('public')->assertExists($oldImagePath);

        $this->actingAs($admin)->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee($product->name);

        $this->actingAs($admin)->get(route('admin.products.edit', $product))
            ->assertOk()
            ->assertSee($product->name);

        // Update without replacing image
        $updateWithoutImage = $this->actingAs($admin)->put(route('admin.products.update', $product), [
            'name' => 'Kaos Streetwear "Merdeka V2" Hitam',
            'category_id' => $category->id,
            'price' => 165000,
            'stock' => 22,
            'description' => 'Kaos katun kombed 24s edisi revisi dengan potongan boxy.',
        ]);

        $updateWithoutImage->assertRedirect(route('admin.products.index'));
        $product->refresh();
        $this->assertSame('Kaos Streetwear "Merdeka V2" Hitam', $product->name);
        $this->assertSame($oldImagePath, $product->image);
        Storage::disk('public')->assertExists($oldImagePath);

        // Update with new image deletes old image
        $secondImage = $this->fakePngUpload('kaos-v2.png');
        $updateWithImage = $this->actingAs($admin)->put(route('admin.products.update', $product), [
            'name' => 'Kaos Streetwear "Merdeka V2" Hitam',
            'category_id' => $category->id,
            'price' => 165000,
            'stock' => 22,
            'description' => 'Kaos katun kombed 24s edisi revisi dengan potongan boxy.',
            'image' => $secondImage,
        ]);

        $updateWithImage->assertRedirect(route('admin.products.index'));
        $product->refresh();
        $newImagePath = $product->image;
        $this->assertNotSame($oldImagePath, $newImagePath);
        Storage::disk('public')->assertMissing($oldImagePath);
        Storage::disk('public')->assertExists($newImagePath);

        // Delete removes DB row and image
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.products.destroy', $product));
        $deleteResponse->assertRedirect(route('admin.products.index'));
        $deleteResponse->assertSessionHas('success');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($newImagePath);
    }

    public function test_admin_store_validation_enforces_required_rules(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)
            ->from(route('admin.products.create'))
            ->post(route('admin.products.store'), [
                'name' => '',
                'category_id' => 999,
                'price' => 500,
                'stock' => -1,
                'description' => 'Pendek',
            ]);

        $response->assertRedirect(route('admin.products.create'));
        $response->assertSessionHasErrors([
            'name',
            'category_id',
            'price',
            'stock',
            'description',
            'image',
        ]);
    }

    /**
     * Create a valid 1x1 PNG upload without requiring the GD extension.
     */
    private function fakePngUpload(string $filename): UploadedFile
    {
        $pngBytes = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=='
        );

        return UploadedFile::fake()->createWithContent($filename, $pngBytes);
    }
}
