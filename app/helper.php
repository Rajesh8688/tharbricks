<?php 
use Illuminate\Support\Str;

if (! function_exists('unique_slug')) {
    function unique_slug($title = '', $model = 'Ad', $id = '')
    {
        //dd($title, $model,$id);
        $slug = Str::slug($title);
        //get unique slug...
        $nSlug = $slug;
        $i = 0;

        $model = str_replace(' ', '', "\App\Models\ " . $model);
        $slugcount = $model::whereSlug($nSlug);
        if (!empty($id)) {
            $slugcount = $slugcount->where('id', '!=', $id);
        }
        $slugcount = $slugcount->count();
       // ddd($slugcount);

        while ($slugcount > 0) {
            $i++;
            $nSlug = $slug . '-' . $i;
        }
        if ($i > 0) {
            $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
        } else {
            $newSlug = $slug;
        }
        return $newSlug;
    }
}
//function for deleteImage image

if (! function_exists('deleteImage')) {
    function deleteImage($imagePath, $imageName)
       {
           $originalPath = $imagePath;
   
           // Delete the previous image
           $imageCheck = $originalPath . $imageName;
   
           if (File::exists($imageCheck)) {
               \File::delete($imageCheck);
           }
           return true;
       }
   }

   if(! function_exists('imagenameMaker')){
    function imagenameMaker($imageOriginalName , $extension = 'png'){
        if(!empty($imageOriginalName)){
            $imageName = Str::slug($imageOriginalName) . '_' . time() . '_' . uniqid() . '.' . $extension;
            return $imageName;
        }
        else{
            //empty
            return 'empty'. time() . '_' . uniqid() . '.png';
        }
       
    }
    
    if (! function_exists('unique_slug')) {
        function unique_slug($title = '', $model = 'Ad', $id = '')
        {
            //dd($title, $model,$id);
            $slug = Str::slug($title);
            //get unique slug...
            $nSlug = $slug;
            $i = 0;
    
            $model = str_replace(' ', '', "\App\Models\ " . $model);
            $slugcount = $model::whereSlug($nSlug);
            if (!empty($id)) {
                $slugcount = $slugcount->where('id', '!=', $id);
            }
            $slugcount = $slugcount->count();
           // ddd($slugcount);
    
            while ($slugcount > 0) {
                $i++;
                $nSlug = $slug . '-' . $i;
            }
            if ($i > 0) {
                $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
            } else {
                $newSlug = $slug;
            }
            return $newSlug;
        }
    }

    function getBase64ImageExtension($base64Image)
    {
        // Extract the base64 image data
        $data = explode(',', $base64Image);

        // Extract the image format
        $format = explode(';', $data[0])[0];

        // Extract the image extension from the format
        $extension = explode('/', $format)[1];

        return $extension;
    }

}
?>