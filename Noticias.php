<?php

namespace App;

use DB;


use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'noticias';
    protected $primaryKey = 'not_id';

    protected $fillable = ['not_no','clu_id_siid','not_fecha','not_img','not_desc','not_desc_cort','not_tit','not_home','not_edit','usu_id','updated_at','created_at'];

    public function scopeNoticiasPorClub($query, $clu_id_siid)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("*")

        ->where("clu_id_siid","=",$clu_id_siid)

        ->orderBy("not_no","DESC");
    }
    public function scopeNoticiasDes($query)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("*")

        ->where("not_cat","<>",4)

        ->orderBy("not_no","DESC")

        ->limit(5);
    }
    public function scopeNoticiasDesClub($query, $clu_id_siid)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("*")

        ->where("clu_id_siid","=",$clu_id_siid)

        ->orderBy("not_no","DESC")

        ->limit(5);
    }
    public function scopeNoticias($query)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("*")

        ->orderBy("not_no","DESC")

        ->limit(1);
    }
    public function scopeNoticiasHoy($query)
    {

            return $query = DB::connection('mysql2')->table("noticias")

            ->select("*")

            ->orderBy("not_no","DESC");
        
    }
    public function scopeNoticiasSA($query)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("*")

        ->where("not_serie","=","SA")

        ->orderBy("not_no","DESC");
    }
    public function scopeNoticiasSB($query)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("*")

        ->where("not_serie","=","SB")

        ->orderBy("not_no","DESC");
    }
    public function scopeNoticiasSA2($query)
    {

        return $query = DB::connection('mysql2')->table("noticias")

        ->select("not_id","clu_id_siid","not_serie","not_home","not_fecha","not_img","not_desc_cort")

        ->where("not_serie","=","SA")

        ->orderBy("not_no","DESC");
    }
    public function scopeNoticiasSB2($query)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("not_id","clu_id_siid","not_serie","not_home","not_fecha","not_img","not_desc_cort")

        ->where("not_serie","=","SB")

        ->orderBy("not_no","DESC");


    }
    public function scopeNoticiasDet($query, $not_id)
    {
        return $query = DB::connection('mysql2')->table("noticias")

        ->select("*")

        ->where("not_id","=",$not_id);
    }
}
