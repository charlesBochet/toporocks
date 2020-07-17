<?php

namespace App\Http\Controllers;

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
        $picture = new Picture();
        $route->name = 'Route Test';
        $route->location = new Point($request->position['lat'], $request->position['lng']);
        $route->author_id = Auth::user()->id;

        $route->save();
        $picture->route_id = $route->id;
        $picture->picture_path = $request->picturePath;
        $picture->traced_picture_path = $request->picturePath;
        $picture->save();

        return response(['route_id', $route->id]);
    }
}
