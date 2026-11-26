<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Seed initial catalog products and generate placeholder product artwork.
     */
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $products = [
            [
                'category_slug' => 'kaos-t-shirt',
                'name' => 'Kaos Oversize "Aseli Lokal" Hitam',
                'price' => 125000,
                'stock' => 25,
                'description' => 'Kaos streetwear potongan boxy oversize berbahan katun kombed 24s premium yang adem dan jatuh rapi. Dilengkapi sablon plastisol high-density bertema "Aseli Lokal" di bagian dada dan punggung untuk tampilan kasual harian yang standout.',
                'type' => 'tee',
                'bg' => '#18181b',
                'garment' => '#27272a',
                'accent' => '#f59e0b',
                'label' => 'ASELI LOKAL',
            ],
            [
                'category_slug' => 'hoodie-jaket',
                'name' => 'Hoodie Boxy "Bandar Street" Abu-Abu',
                'price' => 285000,
                'stock' => 12,
                'description' => 'Hoodie siluet boxy berbahan cotton fleece 330gsm yang tebal namun tetap breathable. Hadir dengan tudung double-layer, saku kanguru kokoh, dan bordir "Bandar Street" bergaya urban.',
                'type' => 'hoodie',
                'bg' => '#3f3f46',
                'garment' => '#71717a',
                'accent' => '#fafafa',
                'label' => 'BANDAR STREET',
            ],
            [
                'category_slug' => 'kaos-t-shirt',
                'name' => 'Kaos Heavyweight "Nusantara Pride" Putih',
                'price' => 140000,
                'stock' => 30,
                'description' => 'Kaos heavyweight 16s katun murni dengan kerah rib tebal anti-melar. Menampilkan ilustrasi grafis "Nusantara Pride" edisi terbatas dengan tinta discharge yang menyatu lembut ke serat kain.',
                'type' => 'tee',
                'bg' => '#e4e4e7',
                'garment' => '#ffffff',
                'accent' => '#059669',
                'label' => 'NUSANTARA PRIDE',
            ],
            [
                'category_slug' => 'aksesoris-topi',
                'name' => 'Topi Snapback "Aseli D" Navy',
                'price' => 95000,
                'stock' => 15,
                'description' => 'Topi snapback 6-panel berbahan twill katun kokoh warna navy dengan bordir timbul logo inisial "D" khas Distro Aseli Aseli. Dilengkapi strap adjustable di bagian belakang untuk kenyamanan maksimal.',
                'type' => 'cap',
                'bg' => '#1e293b',
                'garment' => '#0f172a',
                'accent' => '#38bdf8',
                'label' => 'ASELI D',
            ],
            [
                'category_slug' => 'hoodie-jaket',
                'name' => 'Coach Jacket "Midnight Ride" Hitam',
                'price' => 320000,
                'stock' => 8,
                'description' => 'Coach jacket windbreaker berbahan taslan water-repellent dengan furing katun halus di bagian dalam. Cocok untuk berkendara malam maupun layer gaya streetwear dengan kancing snap matte hitam.',
                'type' => 'jacket',
                'bg' => '#09090b',
                'garment' => '#18181b',
                'accent' => '#ef4444',
                'label' => 'MIDNIGHT RIDE',
            ],
            [
                'category_slug' => 'kaos-t-shirt',
                'name' => 'Kaos Graphic "Kopi & Karya" Cream',
                'price' => 130000,
                'stock' => 20,
                'description' => 'Kaos warna cream hangat berbahan katun kombed 24s yang lembut di kulit. Mengusung ilustrasi tipografi "Kopi & Karya" sebagai apresiasi bagi para kreator dan penikmat kopi lokal.',
                'type' => 'tee',
                'bg' => '#f5f0e6',
                'garment' => '#fef3c7',
                'accent' => '#78350f',
                'label' => 'KOPI & KARYA',
            ],
        ];

        foreach ($products as $item) {
            $categoryId = $categories[$item['category_slug']] ?? Category::first()?->id;

            if (! $categoryId) {
                continue;
            }

            $slug = Str::slug($item['name']);
            $imagePath = "products/{$slug}.svg";

            Storage::disk('public')->put(
                $imagePath,
                $this->buildProductSvg($item['type'], $item['bg'], $item['garment'], $item['accent'], $item['label'])
            );

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $categoryId,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'description' => $item['description'],
                    'image' => $imagePath,
                ]
            );
        }
    }

    /**
     * Build a crisp streetwear product SVG illustration for seeded catalog items.
     */
    private function buildProductSvg(string $type, string $bg, string $garment, string $accent, string $label): string
    {
        $safeLabel = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        $silhouette = match ($type) {
            'hoodie' => '<path d="M225 145 L265 110 C285 95 315 95 335 110 L375 145 L465 190 L435 265 L390 245 L390 450 L210 450 L210 245 L165 265 L135 190 Z" fill="'.$garment.'" stroke="'.$accent.'" stroke-width="4"/><path d="M265 120 Q300 165 335 120" fill="none" stroke="'.$accent.'" stroke-width="4"/><rect x="245" y="340" width="110" height="65" rx="10" fill="none" stroke="'.$accent.'" stroke-width="3" opacity="0.7"/>',
            'jacket' => '<path d="M230 135 L270 115 L330 115 L370 135 L465 190 L435 270 L390 250 L390 455 L210 455 L210 250 L165 270 L135 190 Z" fill="'.$garment.'" stroke="'.$accent.'" stroke-width="4"/><line x1="300" y1="125" x2="300" y2="455" stroke="'.$accent.'" stroke-width="3"/><path d="M265 115 L300 155 L335 115" fill="none" stroke="'.$accent.'" stroke-width="4"/>',
            'cap' => '<path d="M180 310 C180 205 235 155 300 155 C365 155 420 205 420 310 Z" fill="'.$garment.'" stroke="'.$accent.'" stroke-width="4"/><path d="M160 310 Q300 285 465 330 Q320 355 160 325 Z" fill="'.$accent.'" opacity="0.9"/><circle cx="300" cy="152" r="8" fill="'.$accent.'"/>',
            default => '<path d="M235 130 Q300 165 365 130 L470 190 L435 265 L390 240 L390 455 L210 455 L210 240 L165 265 L130 190 Z" fill="'.$garment.'" stroke="'.$accent.'" stroke-width="4"/><path d="M250 133 Q300 172 350 133" fill="none" stroke="'.$accent.'" stroke-width="4"/>',
        };

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="600" height="600">
  <defs>
    <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
      <path d="M 32 0 L 0 0 0 32" fill="none" stroke="{$accent}" stroke-width="0.6" opacity="0.12"/>
    </pattern>
  </defs>
  <rect width="600" height="600" fill="{$bg}"/>
  <rect width="600" height="600" fill="url(#grid)"/>
  <circle cx="300" cy="295" r="190" fill="{$accent}" opacity="0.08"/>
  {$silhouette}
  <text x="300" y="295" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="20" font-weight="800" letter-spacing="3" fill="{$accent}">{$safeLabel}</text>
  <text x="300" y="535" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="14" font-weight="700" letter-spacing="4" fill="{$accent}" opacity="0.85">DISTRO ASELI ASELI</text>
</svg>
SVG;
    }
}
