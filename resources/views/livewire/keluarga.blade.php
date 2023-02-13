<div>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Simple Tables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                data-target="#tambah_keluarga" wire:click="add()">Tambah Data Keluarga</button>
            <br>
            <br>
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('error') }}
                            </div>
                        @endif


                        <div class="card-header">
                            <h3 class="card-title">Responsive Hover Table</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Keluarga</th>
                                        <th>Nama Ayah</th>
                                        <th>Nama Ibu</th>
                                        <th>Tanggal Lahir Ayah</th>
                                        <th>Tanggal Lahir Ibu</th>
                                        <th width="100px" style="text-align: center">Tanggal Lahir Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keluarga as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_keluarga }}</td>
                                            <td>{{ $item->nama_ayah }}</td>
                                            <td>{{ $item->nama_ibu }}</td>
                                            <td>{{ $item->tanggal_lahir_ayah }}</td>
                                            <td>{{ $item->tanggal_lahir_ibu }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default"
                                                        wire:click="delete({{ $item->id }})"">Hapus</button>
                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#update_modal"
                                                        wire:click="edit({{ $item->id }})">Edit</button>

                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#lihat_anak"
                                                        wire:click="anak({{ $item->id }})">Lihat Anak</button>
                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#lihat_cucu"
                                                        wire:click="anak({{ $item->id }})">Lihat Cucu</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <div wire:ignore.self class="modal fade" id="tambah_keluarga" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Keluarga</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Keluagra</label>
                            <input type="text" class="form-control" wire:model="nama_keluarga">
                            @error('nama_keluarga')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ayah</label>
                            <input type="text" class="form-control" wire:model="nama_ayah">

                            @error('nama_ayah')
                                <span class="error">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ibu</label>
                            <input type="text" class="form-control" wire:model="nama_ibu">
                            @error('nama_ibu')
                                <span class="error">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir Ayah</label>
                            <input type="date" class="form-control" wire:model="tanggal_lahir_ayah">
                            @error('tanggal_lahir_ayah')
                                <span class="error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir Ibu</label>
                            <input type="date" class="form-control" wire:model="tanggal_lahir_ibu">
                            @error('tanggal_lahir_ibu')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="tambah_keluarga()">Save
                            changes</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="lihat_anak" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Lihat Anak</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php $listanak = App\Models\Anak::where(['keluarga_id' => $anak])->get(); ?>
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Anak</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listanak as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jk }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="lihat_cucu" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Lihat Cucu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php $cucu = Illuminate\Support\Facades\DB::table('keluarga')
                        ->join('anak', 'keluarga.id', '=', 'anak.keluarga_id')
                        ->join('cucu', 'anak.id', '=', 'cucu.anak_id')
                        ->select('cucu.*')
                        ->where('keluarga.id', '=', $anak)
                        ->get();
                        ?>
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Anak</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cucu as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jk }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>

    </div>


    <div wire:ignore.self class="modal fade" id="update_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Update Modal {{$nama_keluarga}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" wire:model="id_keluarga">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Keluagra</label>
                            <input type="text" class="form-control" wire:model="nama_keluarga">
                            @error('nama_keluarga')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ayah</label>
                            <input type="text" class="form-control" wire:model="nama_ayah">

                            @error('nama_ayah')
                                <span class="error">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ibu</label>
                            <input type="text" class="form-control" wire:model="nama_ibu">
                            @error('nama_ibu')
                                <span class="error">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir Ayah</label>
                            <input type="date" class="form-control" wire:model="tanggal_lahir_ayah">
                            @error('tanggal_lahir_ayah')
                                <span class="error">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir Ibu</label>
                            <input type="date" class="form-control" wire:model="tanggal_lahir_ibu">
                            @error('tanggal_lahir_ibu')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="edit_keluarga()">Save
                            changes</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
