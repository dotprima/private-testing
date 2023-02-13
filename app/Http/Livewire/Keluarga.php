<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Keluarga extends Component

{
    public $nama_keluarga, $nama_ayah, $nama_ibu, $tanggal_lahir_ayah, $tanggal_lahir_ibu,$anak,$id_keluarga;

    protected $rules = [
        'nama_keluarga' => 'required',
        'nama_ayah' => 'required',
        'nama_ibu' => 'required',
        'tanggal_lahir_ayah' => 'required',
        'tanggal_lahir_ibu' => 'required',
    ];

    public function render()
    {
        $keluarga = DB::table('keluarga')->get();

        $data = [
            'keluarga' => $keluarga
        ];

        return view('livewire.keluarga', $data);
    }

    public function resetFields()
    {
        $this->nama_keluarga = '';
        $this->nama_ayah = '';
        $this->nama_ibu = '';
        $this->tanggal_lahir_ayah = '';
        $this->tanggal_lahir_ibu = '';
    }

    public function add()
    {
        $this->resetFields();
    }

    public function edit($id)
    {
        $keluarga = DB::table('keluarga')->find($id);
        $this->id_keluarga = $keluarga->id;
        $this->nama_keluarga =  $keluarga->nama_keluarga;
        $this->nama_ayah = $keluarga->nama_ayah;
        $this->nama_ibu = $keluarga->nama_ibu;
        $this->tanggal_lahir_ayah = $keluarga->tanggal_lahir_ayah;
        $this->tanggal_lahir_ibu = $keluarga->tanggal_lahir_ibu;
    }

    public function anak($id)
    {
        $this->anak = $id;
    }


    public function tambah_keluarga()
    {
        $this->validate();

        session()->flash('success', 'Familly Created Successfully!!');
        try {

            DB::table('keluarga')->insert([
                'nama_keluarga' => $this->nama_keluarga,
                'nama_ayah' => $this->nama_ayah,
                'nama_ibu' => $this->nama_ibu,
                'tanggal_lahir_ayah' => $this->tanggal_lahir_ayah,
                'tanggal_lahir_ibu' => $this->tanggal_lahir_ibu,
            ]);

            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('success', 'Familly Created Successfully!!');
            // Reset Form Fields After Creating Familly
            $this->resetFields();
        } catch (\Exception $e) {
            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating Familly !!');
            // Reset Form Fields After Creating Familly
            $this->resetFields();
        }
    }

    public function edit_keluarga()
    {
        $this->validate();

        try {

            DB::table('keluarga')->where('id', $this->id_keluarga)->update(
                [
                    'nama_keluarga' => $this->nama_keluarga,
                    'nama_ayah' => $this->nama_ayah,
                    'nama_ibu' => $this->nama_ibu,
                    'tanggal_lahir_ayah' => $this->tanggal_lahir_ayah,
                    'tanggal_lahir_ibu' => $this->tanggal_lahir_ibu,
                ]
            );

            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('success', 'Familly Edited Successfully!!');
            // Reset Form Fields After Creating Familly
            $this->resetFields();
        } catch (\Exception $e) {
            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating Familly !!');
            // Reset Form Fields After Creating Familly
            $this->resetFields();
        }
    }


    public function delete($id)
    {
        try {
            $deleted = DB::table('keluarga')->where('id', $id)->delete();
            session()->flash('success', "Fammily Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting Fammily !!");
        }
    }
}
