<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Anak extends Component
{
    public $id_anak,$nama_ayah,$nama,$jk,$tanggal_lahir,$id_keluarga,$cucu;
    public function render()
    {
        $keluarga = DB::table('anak')->join('keluarga', 'anak.keluarga_id', '=', 'keluarga.id')->selectRaw('anak.* , nama_ayah')->get();

        $data = [
            'anaklist' => $keluarga
        ];

        return view('livewire.anak',$data);
    }

    protected $rules = [
        'nama' => 'required',
        'jk' => 'required',
        'tanggal_lahir' => 'required',
    ];

    public function add()
    {
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->nama = '';
        $this->jk = '';
        $this->tanggal_lahir = '';
    }

    public function edit($id)
    {
        $anak = DB::table('anak')->find($id);
        $this->id_anak = $id;
        $this->nama =  $anak->nama;
        $this->jk = $anak->jk;
        $this->tanggal_lahir = $anak->tanggal_lahir;
    }

    public function edit_anak()
    {
        $this->validate();

        try {

            DB::table('anak')->where('id', $this->id_anak)->update(
                [
                    'nama' => $this->nama,
                    'jk' => $this->jk,
                    'tanggal_lahir' => $this->tanggal_lahir,
                ]
            );

            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('success', 'Children Created Successfully!!');
            // Reset Form Fields After Creating Children
            $this->resetFields();
        } catch (\Exception $e) {
            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating Children !!');
            // Reset Form Fields After Creating Children
            $this->resetFields();
        }
    }

    public function anak($id)
    {
        $this->id_anak = $id;
    }

    public function delete($id)
    {
        try {
            $deleted = DB::table('anak')->where('id', $id)->delete();
            session()->flash('success', "Fammily Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting Fammily !!");
        }
    }

    public function deletecucu($id)
    {
        try {
            $deleted = DB::table('cucu')->where('id', $id)->delete();
            session()->flash('success', "Fammily Deleted Successfully!!");
            $this->emit('postUpdated');
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting Fammily !!");
            $this->emit('postUpdated');
        }
    }

    public function tambah_anak()
    {
        $this->validate();

        try {

            DB::table('anak')->insert([
                'nama' => $this->nama,
                'jk' => $this->jk,
                'tanggal_lahir' => $this->tanggal_lahir,
                'keluarga_id' => $this->id_keluarga,
            ]);

            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('success', 'Children Created Successfully!!');
            // Reset Form Fields After Creating Children
            $this->resetFields();
        } catch (\Exception $e) {
            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating Children !!');
            // Reset Form Fields After Creating Children
            $this->resetFields();
        }
    }

    public function tambah_cucu()
    {
        $this->validate();

        try {

            DB::table('cucu')->insert([
                'nama' => $this->nama,
                'jk' => $this->jk,
                'tanggal_lahir' => $this->tanggal_lahir,
                'anak_id' => $this->id_anak,
            ]);

            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('success', 'Children Created Successfully!!');
            // Reset Form Fields After Creating Children
            $this->resetFields();
        } catch (\Exception $e) {
            $this->emit('postUpdated');
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating Children !!');
            // Reset Form Fields After Creating Children
            $this->resetFields();
        }
    }
}
