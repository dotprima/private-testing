<?php

namespace App\Http\Controllers;
use App\Models\anak;
use App\Models\cucu;
use App\Models\keluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ApiController extends Controller
{

    function getallfamilly(){
        $familly = keluarga::all();
        if ($familly->isEmpty()) {
            return response()->json(['message' => 'Data keluarga tidak ditemukan.'], 404);
        }

        return response()->json($familly, 200);
    }

    function getallchild(){
        $familly = cucu::all();
        if ($familly->isEmpty()) {
            return response()->json(['message' => 'Data keluarga tidak ditemukan.'], 404);
        }

        return response()->json($familly, 200);
    }


    function getallgrandchild(){
        $familly = anak::all();
        if ($familly->isEmpty()) {
            return response()->json(['message' => 'Data keluarga tidak ditemukan.'], 404);
        }

        return response()->json($familly, 200);
    }

    function familly(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_keluarga' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'tanggal_lahir_ayah' => 'required|date',
            'tanggal_lahir_ibu' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try{
            $keluarga = new keluarga();
            $keluarga->fill([
                'nama_keluarga' => $request->input('nama_keluarga'),
                'nama_ayah' => $request->input('nama_ayah'),
                'nama_ibu' => $request->input('nama_ibu'),
                'tanggal_lahir_ayah' => $request->input('tanggal_lahir_ayah'),
                'tanggal_lahir_ibu' => $request->input('tanggal_lahir_ibu'),
            ]);
            $keluarga->save();

            return response()->json([
                'status' => 'success',
                'data' => $keluarga
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }

    }

    function child(Request $request){
        $validator = Validator::make($request->all(), [
            'keluarga_id' => 'required|integer',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $keluarga = new anak();
            $keluarga->fill([
                'keluarga_id' => $request->input('keluarga_id'),
                'nama' => $request->input('nama'),
                'jk' => $request->input('jk'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
            ]);
            $keluarga->save();

            return response()->json([
                'status' => 'success',
                'data' => $keluarga
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }

    }

    function grandchild(Request $request){
        $validator = Validator::make($request->all(), [
            'anak_id' => 'required|integer',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $keluarga = new cucu();
            $keluarga->fill([
                'anak_id' => $request->input('anak_id'),
                'nama' => $request->input('nama'),
                'jk' => $request->input('jk'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
            ]);
            $keluarga->save();

            return response()->json([
                'status' => 'success',
                'data' => $keluarga
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }

    }

    function update_familly(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_keluarga' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'tanggal_lahir_ayah' => 'required|date',
            'tanggal_lahir_ibu' => 'required|date',
            'id_familly' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try{
            $keluarga = keluarga::find($request->input('id_familly'));

            $keluarga->nama_keluarga = $request->input('nama_keluarga');
            $keluarga->nama_ayah = $request->input('nama_ayah');
            $keluarga->nama_ibu = $request->input('nama_ibu');
            $keluarga->tanggal_lahir_ayah = $request->input('tanggal_lahir_ayah');
            $keluarga->tanggal_lahir_ibu = $request->input('tanggal_lahir_ibu');

            $keluarga->save();

            return response()->json([
                'status' => 'success',
                'data' => $keluarga
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }

    }

    function update_child(Request $request){
        $validator = Validator::make($request->all(), [
            'id_anak' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required|date',
            'keluarga_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try{
            $anak = anak::find($request->input('id_anak'));
            $anak->nama = $request->input('nama');
            $anak->jk = $request->input('jk');
            $anak->tanggal_lahir = $request->input('tanggal_lahir');
            $anak->keluarga_id = $request->input('keluarga_id');

            $anak->save();

            return response()->json([
                'status' => 'success',
                'data' =>  $anak
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }

    }


    function update_grandchild(Request $request){
        $validator = Validator::make($request->all(), [
            'anak_id' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required|date',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try{
            $anak = cucu::find($request->input('id'));
            $anak->nama = $request->input('nama');
            $anak->jk = $request->input('jk');
            $anak->tanggal_lahir = $request->input('tanggal_lahir');
            $anak->anak_id = $request->input('anak_id');

            $anak->save();

            return response()->json([
                'status' => 'success',
                'data' =>  $anak
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }

    }


    function delete_familly(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $keluarga = keluarga::find($request->input('id'));

            $keluarga->delete();

            return response()->json([
                'status' => 'success',
                'data' => $keluarga
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    function delete_child(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $anak = anak::find($request->input('id'));

            $anak->delete();

            return response()->json([
                'status' => 'success',
                'data' => $anak
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }


    function delete_grandchild(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $cucu = cucu::find($request->input('id'));

            $cucu->delete();

            return response()->json([
                'status' => 'success',
                'data' => $cucu
            ], 201);
        }catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }






}
