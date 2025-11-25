<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\User;

class UserPanel extends Component
{
    public int $perPage = 1;
    public string $Nimi = "";
    public string $Sähköposti = "";
    public string $Puhelin = "";
    public string $Salasana = "";
    public string $SalasanaConfirm = "";

    public function messages()
    {
        return [
            'Salasana.regex' => 'Salasanan täytyy sisältää vähintään yhden erikoismerkin (esim. !@#$%^&*).',
            'Salasana.same' => 'Salasanat eivät täsmää.',
            'Salasana.min' => 'Salasanan on oltava vähintään 8 merkkiä pitkä.',
        ];
    }


    #[Computed]
    public function users()
    {
        return User::orderBy('Luotu', 'asc')
            ->limit($this->perPage)
            ->get();
    }

    public function addUser()
    {
        $this->validate([
            'Nimi' => 'required|string|max:255',
            'Sähköposti' => 'required|email|unique:users,Sähköposti',
            'Puhelin' => 'nullable|string|max:20',
            'Salasana' => [
                'required',
                'min:8',
                'same:SalasanaConfirm',
                'regex:/[!@#$%^&*(),.?\":{}|<>]/'
            ],
            'SalasanaConfirm' => 'required|min:8',
        ]);

        User::create([
            'Nimi' => $this->Nimi,
            'Sähköposti' => $this->Sähköposti,
            'Puhelin' => $this->Puhelin,
            'SalasanaHash' => bcrypt($this->Salasana),
        ]);

        $this->reset([
            'Nimi',
            'Sähköposti',
            'Puhelin',
            'Salasana',
            'SalasanaConfirm',
        ]);
    }

    public function render()
    {
        return view('livewire.user-panel');
    }
}
