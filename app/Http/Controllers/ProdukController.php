<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProdukController extends Controller
{
    // KATEGORI
    public function kategori_view()
    {
        $categories = Category::all();

        // Mengirim data kategori ke view
        return view('admin.produk.kategori', compact('categories'));
    }

    public function kategori_view_add()
    {
        return view('admin.produk.add_kategori');
    }

    public function kategori_delete($id)
    {
        // Cari kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Hapus kategori
        $category->delete();

        // Redirect kembali ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('kategori.view')->with('success', 'Kategori berhasil dihapus!');
    }


    
    //PRODUK
    public function produk_view()
    {
        $products = Product::paginate(10); 

        // Mengirim data produk ke view
        return view('admin.produk.produk', compact('products'));
    }

    public function produk_view_add()
    {
        $categories = Category::all();
        return view('admin.produk.add_produk', compact('categories'));
    }

    public function produk_edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.produk.edit_produk', compact('product', 'categories'));
    }

    public function produk_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image_main' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_thumbnails.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;

        // Update gambar utama
        if ($request->hasFile('image_main')) {
            $mainImage = $request->file('image_main')->store('products/main', 'public');
            $product->image_main = $mainImage;
        }

        // Update gambar thumbnail
        if ($request->hasFile('image_thumbnails')) {
            $thumbnails = [];
            foreach ($request->file('image_thumbnails') as $file) {
                $thumbnails[] = $file->store('products/thumbnails', 'public');
            }
            $product->image_thumbnails = json_encode($thumbnails);
        }

        $product->save();

        return redirect()->route('produk.view')->with('success', 'Produk berhasil diperbarui!');
    }

    public function kategori_store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data kategori
        $category = Category::create([
            'name' => $request->name,
        ]);

        

        // Redirect ke halaman daftar kategori setelah berhasil
        return redirect()->route('kategori.view')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function produk_store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image_main' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_thumbnails' => 'nullable|array',
            'image_thumbnails.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string',
        ]);

        // Simpan gambar utama
        $imageMainPath = $request->file('image_main')->store('products', 'public');

        // Simpan gambar thumbnail
        $thumbnails = [];
        if ($request->hasFile('image_thumbnails')) {
            foreach ($request->file('image_thumbnails') as $thumbnail) {
                $thumbnails[] = $thumbnail->store('products', 'public');
            }
        }

        // Simpan data produk
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');
        $product->image_main = $imageMainPath;
        $product->image_thumbnails = json_encode($thumbnails);  // Menyimpan gambar thumbnail dalam format JSON
        
        $product->features = json_encode($request->input('features'));
          // Menyimpan fitur produk dalam format JSON
        $product->save();

        // Redirect setelah menyimpan
        return redirect()->route('produk.view')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function produk_detail($id)
    {
        try {
            $product = Product::with('category')->findOrFail($id);
            return view('admin.produk.detail_produk', compact('product'));
        } catch (\Exception $e) {
            return redirect()->route('produk.view')->with('error', 'Produk tidak ditemukan.');
        }
    }



    public function produk_delete($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Hapus gambar utama
        if ($product->image_main && Storage::disk('public')->exists($product->image_main)) {
            Storage::disk('public')->delete($product->image_main);
        }

        // Hapus gambar thumbnail
        if ($product->image_thumbnails) {
            $thumbnails = json_decode($product->image_thumbnails, true);
            if (is_array($thumbnails)) {
                foreach ($thumbnails as $thumbnail) {
                    if (Storage::disk('public')->exists($thumbnail)) {
                        Storage::disk('public')->delete($thumbnail);
                    }
                }
            }
        }

        // Hapus data produk dari database
        $product->delete();

        // Redirect kembali ke halaman daftar produk dengan pesan sukses
        return redirect()->route('produk.view')->with('success', 'Produk berhasil dihapus beserta semua gambarnya.');
    }




    //CUSTOMER
    public function detail_produk_customer($id)
    {
        $product = Product::findOrFail($id);
        return view('customer.produk.detail_produk', compact('product'));
    }

    public function getProducts()
{
    $products = Product::select(
        'id',
        'name',
        'description',
        'price as original_price', // Harga asli
        'price', // Harga diskon (jika ada)
        'stock as sold_count', // Gunakan stok sebagai pengganti sold_count
        'category_id',
        'image_main as image', // Gambar utama produk
        'image_thumbnails',
        'features',
        'created_at',
        'updated_at'
    )->get();

    // Tambahkan field tambahan
    $products = $products->map(function ($product) {
        $product->rating = rand(3, 5); // Contoh rating
        $product->location = "Jakarta Pusat"; // Lokasi default
        $product->discount = null;
        $product->is_mall = true;
        $product->has_cashback = false;
        $product->has_free_shipping = false;

        // Hitung diskon jika ada
        if ($product->original_price > $product->price) {
            $discount = (($product->original_price - $product->price) / $product->original_price) * 100;
            $product->discount = round($discount) . '%';
        }

        return $product;
    });

    return response()->json($products);
}


}
