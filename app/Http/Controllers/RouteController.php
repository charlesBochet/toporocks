<?php

namespace App\Http\Controllers;

use App\Ascent;
use App\Http\Requests\RouteRequest;
use App\Picture;
use App\Route;
use Illuminate\Support\Facades\Auth;
use \MStaack\LaravelPostgis\Geometries\Point;

class RouteController extends Controller
{
    public function create(RouteRequest $request)
    {
        $route = new Route();
        $route->name = 'Route Test';
        $route->location = new Point($request->position['lng'], $request->position['lat']);
        $route->author_id = Auth::user()->id;
        $route->save();

        $picture = new Picture();
        $picture->route_id = $route->id;
        $picture->picture_path = $request->picturePath;
        $picture->traced_picture_path = $request->tracedPicturePath;
        $picture->save();

        $ascent = new Ascent();
        $ascent->picture_id = $picture->id;
        $ascent->route_id = $route->id;
        $ascent->grade = $request->grade;
        $ascent->author_id = Auth::user()->id;
        $ascent->save();

        return response(['route_id', $route->id]);
    }

    public function fetchAll()
    {
        return response(Route::with('ascents')->get());
    }
}
