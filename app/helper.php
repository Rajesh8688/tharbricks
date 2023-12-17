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
?>