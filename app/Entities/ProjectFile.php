<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'name',
    	'description',
    	'extension',
        'project_id'
    ];

    /**
     * Notas de um projeto
     * 
     * @return [array]
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
