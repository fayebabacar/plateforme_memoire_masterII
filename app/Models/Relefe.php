<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relefe extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        'ph'       => 'ph',
        'niveau'   => 'niveau',
        'humidite' => 'humidite',
    ];

    public $table = 'releves';

    protected $dates = [
        'date_releve',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'pointdeau_id',
        'date_releve',
        'temperature',
        'value',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pointdeau()
    {
        return $this->belongsTo(Pointdeau::class, 'pointdeau_id');
    }

    public function getDateReleveAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateReleveAttribute($value)
    {
        $this->attributes['date_releve'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
