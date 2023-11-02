<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Utils extends Model
{
    use HasFactory;
    use SoftDeletes;

    static function entityColumns( $entity ){
        $columns = DB::connection()->getSchemaBuilder()->getColumnListing( $entity );
        return $columns;
    }
}
