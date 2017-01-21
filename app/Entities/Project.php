<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'owner_id',
    	'client_id',
    	'name',
    	'description',
    	'progress',
    	'status',
    	'due_date'
    ];

    /**
     * Notas de um projeto
     * 
     * @return [array]
     */
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    /**
     * Retorna os membros do projeto
     * 
     * @return [array]
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }

    /**
     * Retorna as notas do projeto
     * 
     * @return [array]
     */
    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }

    /**
     * Retorna os arquivos do projeto
     * 
     * @return [array]
     */
    public function files()
    {
        return $this->hasMany(ProjectFiles::class);
    }
    
}
