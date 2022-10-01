<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Theme;
use Illuminate\Http\Request;

/**
 * Observable : true
 * Name : Theme
 * Description : list method theme controller
 */
class ThemeController extends Controller
{
    public function validatedThemeId($validator)
    {
        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        return $validator->validated();
    }

    /**
     * Observable : true
     * Name : load theme
     * Description : load theme by id
     */
    public function loadThemeById($request, $results)
    {
        $theme = json_decode($request->personalization);

        $results['theme'] = $this->show(
            $this->validatedThemeId($this->validateId(['id' => $theme->theme], "Theme"))
        );
        return $results;
    }

    public function show($id)
    {
        return Theme::find($id)->first();
    }
}
