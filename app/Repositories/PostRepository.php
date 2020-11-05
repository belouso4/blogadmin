<?php


namespace App\Repositories;

use App\Models\Post;
use App\Models\Post as Model;

class PostRepository extends CoreRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllPosts($perpage)
    {
        $get_all = $this->startConditions()->with('category')
            ->where('status', '1')
            ->orderBy(\DB::raw('LENGTH(posts.title)','posts.title'))
        ->limit($perpage)
        ->paginate($perpage);

        return $get_all;
    }

    public function getCountPosts()
    {
        $count = $this->startConditions()
            ->count();

        return $count;
    }

    public function getIdByAlias($alias) {
        $post = $this->startConditions()
            ->where('alias','=', $alias)
            ->first();
        return $post;
    }

    public function uploadImg($filename, $wmax, $hmax) {

       $uploaddir = 'uploads/single/';
       $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $filename));
        $uploadfile = $uploaddir . $filename;
        \Session::put('single', $filename);
//        self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
    }
//
//    public function uploadGallery($filename, $wmax, $hmax)
//    {
//        $uploaddir = 'uploads/gallery/';
//        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$filename]['name']));
//        $new_name = md5(time()) . ".$ext";
//        $uploadfile = $uploaddir . $new_name;
//        \Session::push('gallery', $new_name);
//
//        if (@move_uploaded_file($_FILES[$filename]['tmp_name'], $uploadfile)) {
//            self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
//            $res = array("file" => $new_name);
//
//            echo json_encode($res);
//
//        }
//
//    }
//
    public function getImg(Post $post)
    {
        clearstatcache();
        if (!empty(\Session::get('single'))) {
            $name = \Session::get('single');
            $post->img = $name;
            \Session::forget('single');
            return;
        }

        if (empty(\Session::get('single')) && !is_file(WWW . '/uploads/single/' . $post->img)) {
            $post->img = null;
        }
        return;
    }
//
//    public function editFilter($id, $data)
//    {
//        $filter = \DB::table('attribute_products')
//            ->where('product_id', $id)
//            ->pluck('attr_id')
//            ->toArray();
//
//        if (empty($data['attrs']) && !empty($filter)) {
//            \DB::table('attribute_products')
//                ->where('product_id', $id)
//                ->delete();
//        }
//
//        if (empty($filter) && !empty($data['attrs'])) {
//
//            $sql_part = '';
//            foreach ($data['attrs'] as $v) {
//                $sql_part .= "($v, $id),";
//            }
//
//            $sql_part = rtrim($sql_part, ',');
//            \DB::insert("insert into attribute_products (attr_id, product_id) VALUES $sql_part");
//            return;
//        }
//
//        if (!empty($data['attrs'])) {
//
//            \DB::table('attribute_products')
//                ->where('product_id', $id)
//                ->delete();
//
//            $sql_part = '';
//            foreach ($data['attrs'] as $v) {
//                $sql_part .= "($v, $id),";
//            }
//
//            $sql_part = rtrim($sql_part, ',');
//            \DB::insert("insert into attribute_products (attr_id, product_id) VALUES $sql_part");
//            return;
//        }
//    }
//
//
//    public function editRelatedProduct($id, $data)
//    {
//        $related_product = \DB::table('related_products')
//            ->select('related_id')
//            ->where('product_id', $id)
//            ->pluck('related_id')
//            ->toArray();
//
//        if (empty($data['related']) && !empty($related_product)) {
//            \DB::table('related_products')
//                ->where('product_id', $id)
//                ->delete();
//        }
//
//        if (empty($related_product) && !empty($data['related'])) {
//
//            $sql_part = '';
//            foreach ($data['related'] as $v) {
//                $v = (int)$v;
//                $sql_part .= "($id, $v),";
//            }
//
//            $sql_part = rtrim($sql_part, ',');
//            \DB::insert("insert into related_products (product_id, related_id) VALUES $sql_part");
//            return;
//        }
//
//        if (!empty($data['related'])) {
//
//            $result = array_diff($related_product, $data['related']);
//            if (!empty($result) || count($related_product) != count($data['related'])) {
//                \DB::table('related_products')
//                    ->where('product_id', $id)
//                    ->delete();
//
//                $sql_part = '';
//                foreach ($data['related'] as $v) {
//                    $sql_part .= "($id, $v),";
//                }
//
//                $sql_part = rtrim($sql_part, ',');
//                \DB::insert("insert into related_products (product_id, related_id) VALUES $sql_part");
//                return;
//            }
//        }
//    }
//
//    public function saveGallery($id)
//    {
//
//        if (!empty(\Session::get('gallery'))) {
//            $sql_part = '';
//            foreach (\Session::get('gallery') as $v) {
//                $sql_part .= "($id, '$v'),";
//            }
//
//            $sql_part = rtrim($sql_part, ',');
//
//            \DB::insert("insert into galleries (product_id, img) VALUES $sql_part");
//            \Session::forget('gallery');
//
//
//        }
//    }
//

//
//    public function getFilterProduct($id)
//    {
//        $filter =  \DB::table('attribute_products')
//            ->select('attr_id')
//            ->where('product_id', $id)
//            ->pluck('attr_id')
//            ->all();
//        return $filter;
//    }
//
//    public function getRelatedProducts($id)
//    {
//        $related_products = $this->startConditions()
//            ->join('related_products', 'products.id', '=', 'related_products.related_id')
//            ->select('products.title', 'related_products.related_id')
//            ->where('related_products.product_id', $id)
//            ->get();
//
//        return $related_products;
//    }
//
//    public function getGallery($id)
//    {
//        $gallery = \DB::table('galleries')
//            ->where('product_id', $id)
//            ->get()
//            ->pluck('img')
//            ->all();
//        return $gallery;
//    }
//
    public function returnStatusOne($id)
    {
        if (isset($id)) {
            $st = \DB::update("UPDATE posts SET status = '1' WHERE id = ?", [$id]);
            if ($st) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteStatusOne($id)
    {
        if (isset($id)) {
            $st = \DB::update("UPDATE posts SET status = '0' WHERE id = ?", [$id]);
            if ($st) {
                return true;
            } else {
                return false;
            }
        }
    }
//
//    public function deleteImgGalleryFromPath($id)
//    {
//        $galleryImg = \DB::table('galleries')
//            ->select('img')
//            ->where('id', $id)
//            ->pluck('img')
//            ->all();
//
//        $singleImg = \DB::table('products')
//            ->select('img')
//            ->where('id', $id)
//            ->pluck('img')
//            ->all();
//
//        if (!empty($galleryImg)) {
//            foreach ($galleryImg as $img) {
//                @unlink("uploads/gallery/$img");
//            }
//        }
//
//        if (!empty($singleImg)) {
//            @unlink("uploads/single/" . $singleImg[0]);
//        }
//    }
//
    public function deleteFromDB($id)
    {
        if (isset($id)) {
            $post = \DB::delete('DELETE FROM posts WHERE id = ?', [$id]);

            if ($post) {
                return true;
            }

        }
    }

    public static function resize($target, $dest ,$wmax, $hmax, $ext) {

       list($w_orig, $h_orig) = getimagesize($target);
       $ratio = $w_orig / $h_orig;

       if (($wmax / $hmax) > $ratio) {
           $wmax = $hmax / $ratio;
       } else {
           $hmax = $wmax / $ratio;
       }

       $img = "";
       switch ($ext) {
           case ('gif'):
               $img = imagecreatefromgif($target);
               break;
           case ('png'):
               $img = imagecreatefrompng($target);
               break;
           default:
               $img = imagecreatefromjpeg($target);
       }
       $newImg = imagecreatetruecolor($wmax, $hmax);
       if ($ext == 'png') {
           imagesavealpha($newImg, true);
           $transPng = imagecolorallocatealpha($newImg, 0,0,0,127);
           imagefill($newImg, 0, 0, $transPng);
       }
       imagecopyresampled($newImg, $img, 0,0,0,0, $wmax, $hmax, $w_orig, $h_orig);
        switch ($ext) {
            case ('gif'):
                imagegif($newImg, $dest);
                break;
            case ('png'):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
       imagedestroy($newImg);
    }



}
