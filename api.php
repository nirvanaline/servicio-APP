<?php
 

use App\User;
use App\Goles;
use App\Torneo;
use App\Equipo;
use App\Accion;
use App\Jersey;
use App\Onboarding;
use App\Jugada;
use App\Evento;
use App\Jornadas;
use App\Temporada;
use App\Noticias;
use App\GoleadorSA;
use App\OfensivaSA;
use App\Funciones;
use App\EventoPartido;
use Illuminate\Http\Request;
use App\Http\Resources\HomeAPIResource;
use App\Http\Resources\PagesResource;
use App\Http\Resources\NoticiasResource;
use App\Http\Resources\NoticiasDesResource;
use App\Http\Resources\NoticiasSerieResource;
use App\Http\Resources\NoticiasDetalleResource;
use App\Http\Resources\JerseyResource;
use App\Http\Resources\OnboardingResource;
use App\Http\Resources\V_JugadorResource;
use App\Http\Resources\TarjetasResource;
use App\Http\Resources\ResultadosResource;
use App\Http\Resources\ResultadoJugador;
use App\Http\Resources\ResultadosAppResource;
use App\Http\Resources\JugadoresResource;
use App\Http\Resources\AppResource;
use App\Http\Resources\Jug_comp_regResource;
use App\Http\Resources\ClubesResource;
use App\Http\Resources\GolesResource;
use App\Http\Resources\AccionResource;
use App\Http\Resources\TorneoResource;
use App\Http\Resources\EquipoResource;
use App\Http\Resources\JugadaResource;
use App\Http\Resources\EventoResource;
use App\Http\Resources\JornadasResource;
use App\Http\Resources\TemporadaResource;
use App\Http\Resources\GoleadorSAResource;
use App\Http\Resources\OfensivaSAResource;
use App\Http\Resources\AccionPartidoResource;
use App\Http\Resources\EventoPartidoResource;
use App\Http\Resources\Resultados_JugadorResource;
use App\Http\Resources\Resultados_JugadoresResource;
use App\Http\Resources\Tabla_PosicionesResource;
use App\Http\Resources\NoticiasHoyResource;
use App\Http\Resources\Resultados_Partidos_JugadorResource;
use App\CustomClasses\ColectionPaginate;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Http\Resources\NoticiasSerieCollection;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});
Route::get('/jornadas', function() { 
	return JornadasResource::collection(Jornadas::JornadasActivas()->get());
});
Route::get('/torneo', function() {
	return TorneoResource::collection(Torneo::TorneoActivo()->get());
});
Route::get('/temporada', function() {
	return TemporadaResource::collection(Temporada::TemporadaActiva()->get());
});
Route::get('/equipos', function() {
    return EquipoResource::collection(Equipo::all());
});
Route::get('/goleoSA', function() {
	return GoleadorSAResource::collection(GoleadorSA::GoleadorTorneoSA()->get());
});
Route::get('/ofensivaSA', function() {
	return OfensivaSAResource::collection(OfensivaSA::OfensivaTorneoSA()->get());
});
Route::get('/acciones', function() {
	return AccionResource::collection(Accion::Acciones()->get());
});
Route::get('/accionespartido', function() {
	return AccionResource::collection(Accion::Acciones()->get());
});
Route::get('/{tipo_evento}/eventos', function($tipo_evento) {
	return EventoResource::collection(Evento::Eventos($tipo_evento)->get());
});
Route::get('/{id_resultado}/eventos_partido', function($id_resultado) {
	return EventoPartidoResource::collection(EventoPartido::EventosPartido($id_resultado)->get());
});
Route::get('/asistenciasa', function() {
	return PagesResource::collection(Funciones::AsisTotalSA()->get());
});
Route::get('/goles', function() {
	$goles=GolesResource::collection(Funciones::Goles()->get());
    return Response::json(
            array('goles' => $goles,),200);
});
Route::get('/tarjetas', function() {
	$tarjetas=TarjetasResource::collection(Funciones::Tarjetas()->get());
    return Response::json(
            array('tarjetas' => $tarjetas,),200);
});
Route::get('/clubes', function() {
	$clubes=ClubesResource::collection(Funciones::ClubesActivos()->get());
    return Response::json(
            array('clubes' => $clubes,),200);
});
Route::get('/{clu_id}/resultadosweb', function($clu_id) {
	$resultados=ResultadosResource::collection(Funciones::ResultadoWeb($clu_id)->get());
    return Response::json(
            array('resultados' => $resultados,),200);
});
Route::get('/{jug_nui}/jug', function($jug_nui) {
	$resultados=JugadoresResource::collection(Funciones::Jugador($jug_nui)->get());
    return Response::json(
            array('ResultadosApp' => $resultados,),200); 
});
Route::get('/jugadores', function() {
	return Jug_comp_regResource::collection(Funciones::Jug_comp_reg()->get());
});
Route::get('/usuarios', function() {
	$user=User::all();
    return Response::json(
            array('user' => $user,),200);
});

Route::get('/home', function() {
    return HomeAPIResource::collection(Noticias::Noticias()->get());
    
    // $hoy=NoticiasHoyResource::collection(Noticias::NoticiasHoy()->paginate(5));
    // return response( array ('hoy' => $hoy->response()->getData(true)), 200);

    // $serie_a=NoticiasSerieResource::collection(Noticias::NoticiasSA()->paginate(5));
    // return response( array ('serie_a' => $serie_a->response()->getData(true)), 200);

    // $serie_b=NoticiasSerieResource::collection(Noticias::NoticiasSA()->paginate(5));
    // return response( array ('serie_b' => $serie_b->response()->getData(true)), 200);

    // $destacadas=NoticiasDesResource::collection(Noticias::NoticiasDes()->paginate(5));
    // return response( array ('destacadas' => $destacadas->response()->getData(true)), 200);
});

Route::get('/detalle/{not_id}/', function($not_id) {
    $noticias=NoticiasDetalleResource::collection(Noticias::NoticiasDet($not_id)->get());
    return Response::json(
            array('detalle' => $noticias,),200);
});
Route::get('/serie_a', function() {
    // $noticias = NoticiasSerieResource::collection(Noticias::NoticiasSA2()->get());
    // return Response::json(
    //         array('serie_a' => $noticias,),200);
    $noticias = NoticiasSerieResource::collection(Noticias::NoticiasSA2()->paginate(10));
    return response( array ('serie_a' => $noticias->response()->getData(true)), 200);
});

Route::get('/serie_b', function() { 

    $noticias = NoticiasSerieResource::collection(Noticias::NoticiasSB2()->paginate(10));
    return response( array ('serie_b' => $noticias->response()->getData(true)), 200);

   


});
Route::get('/destacados_club/{clu_id}', function($clu_id_siid) {
    $noticias=NoticiasDesResource::collection(Noticias::NoticiasDesClub($clu_id_siid)->get());
    return Response::json(
        array('destacados_club' => $noticias,),200);
});
Route::middleware(['cors'])->group(function(){
    Route::get('/v_goles', function() {
    	$goles=GolesResource::collection(Funciones::V_Goles()->get());
        return Response::json(
                array('goles' => $goles,),200);
    });
    Route::get('/{id_clu}/v_resultados_clubes', function($id_clu) {
    	$resultados_clubes=ResultadosResource::collection(Funciones::V_Resultados_Clubes($id_clu)->get());
        return Response::json(
                array('resultados_clubes' => $resultados_clubes,),200);
    });
    Route::get('/{jug_nui}/v_resultados_jugador', function($jug_nui) {
    	$resultados_jugador=Resultados_JugadorResource::collection(Funciones::V_Resultados_Jugador($jug_nui)->get());
        return Response::json(
                array('resultados_jugador' => $resultados_jugador,),200);
    }); 
    Route::get('/{res_id}/v_resultados_jugadores', function($res_id) {
    	$resultados_jugadores=Resultados_JugadoresResource::collection(Funciones::V_Resultados_Jugadores($res_id)->get());
        return Response::json(
                array('resultados_jugadores' => $resultados_jugadores,),200);
    });
    Route::get('/v_tabla_posiciones', function() {
    	$tabla_posiciones=Tabla_PosicionesResource::collection(Funciones::V_Tabla_Posiciones()->get());
        return Response::json(
                array('tabla_posiciones' => $tabla_posiciones,),200);
    });
    Route::get('/{res_id}/{jug_nui}/v_resultados_partido_jugador', function($res_id, $jug_nui) {
        $v_resultados_partido_jugador=Resultados_Partidos_JugadorResource::collection(Funciones::V_Resultados_Partido_Jugador($res_id, $jug_nui)->get());
        return Response::json(
                array('v_resultados_partido_jugador' => $v_resultados_partido_jugador,),200);
    });
    Route::get('/{jug_nui}/v_jugador', function($jug_nui) {
        $v_jugador=Funciones::V_Jugador($jug_nui);
        return Response::json(
                array('v_jugador' => $v_jugador,),200);
    });

    Route::get('/v_tarjetas', function() {
    	$tarjetas=TarjetasResource::collection(Funciones::V_Tarjetas()->get());
        return Response::json(
                array('tarjetas' => $tarjetas,),200);
    });
    Route::get('/jersey', function() { 
        return JerseyResource::collection(Jersey::JerseyActivos()->get());
    });

    Route::get('/onboarding', function() {
        return OnboardingResource::collection(Onboarding::OnboardingActivos()->get());
    });

    Route::get('/{clu_id}/destacados', function($clu_id_siid) {
        $noticias=NoticiasDesResource::collection(Noticias::NoticiasDes($clu_id_siid)->get());
        return Response::json(
                array('destacados' => $noticias,),200);
    });
    Route::get('/applp', function() {
        Route::get('/hoy', function() {
            $noticias=NoticiasHoyResource::collection(Noticias::NoticiasHoy()->get());
            return Response::json(
                    array('hoy' => $noticias,),200);
        });
        
        Route::get('/detalle/{not_id}', function($not_id) {
            $noticias=NoticiasDetalleResource::collection(Noticias::NoticiasDet($not_id)->get());
            return Response::json(
                    array('detalle' => $noticias,),200);
        });
        Route::get('/{not_id}/detalle', function($not_id) {
            $noticias=NoticiasDetalleResource::collection(Noticias::NoticiasDet($not_id)->get());
            return Response::json(
                    array('detalle' => $noticias,),200);
        });
    });
}); 