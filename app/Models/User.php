<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;  // Adicione a importação da interface JWTSubject
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject  // Implemente a interface JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();  // Retorna o identificador do usuário (id por padrão)
    }

    /**
     * Get custom claims for the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];  // Retorna um array vazio, mas pode adicionar qualquer dado extra ao token aqui
    }
}
