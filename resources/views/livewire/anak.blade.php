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
                        <li class="breadcrumb-item active">List Anak</li>
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
                                        <th>Nama</th>
                                        <th>Nama Ayah</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th width="100px" style="text-align: center"> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anaklist as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->nama_ayah }}</td>
                                            <td>{{ $item->jk }}</td>
                                            <td>{{ $item->tanggal_lahir }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default"
                                                        wire:click="delete({{ $item->id }})"">Hapus</button>
                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#update_modal"
                                                        wire:click="edit({{ $item->id }})">Edit</button>
                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#lihat_cucu"
                                                        wire:click="anak({{ $item->id }})">Lihat Cucu</button>
                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#tambah_cucu"
                                                        wire:click="anak({{ $item->id }})">Tambah Cucu</button>
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
                        <?php $listkeluarga = App\Models\Keluarga::all(); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" wire:model="tanggal_lahir">
                            @error('tanggal_lahir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <select class="form-control" wire:model="jk">
                                <option>Pilih</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jk')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Ayah</label>
                            <select class="form-control" wire:model="id_keluarga">
                                <option>Pilih</option>
                                @foreach ($listkeluarga as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_ayah }}</option>
                                @endforeach
                            </select>
                            @error('id_keluarga')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="tambah_anak()">Save
                            changes</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="tambah_cucu" style="display: none;" aria-hidden="true">
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
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" wire:model="tanggal_lahir">
                            @error('tanggal_lahir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                            <select class="form-control" wire:model="jk">
                                <option>Pilih</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jk')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="tambah_cucu()">Save
                            changes</button>
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
                        <?php $listcucu = Illuminate\Support\Facades\DB::table('keluarga')
                            ->join('anak', 'keluarga.id', '=', 'anak.keluarga_id')
                            ->join('cucu', 'anak.id', '=', 'cucu.anak_id')
                            ->select('cucu.*')
                            ->where('anak.id', '=', $id_anak)
                            ->get();
                        ?>
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Anak</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listcucu as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jk }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td><button type="button" class="btn btn-default btn-sm "
                                                wire:click="deletecucu({{ $item->id }})"">Hapus Cucu</button></td>
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
                        <h4 class="modal-title">Update Anak {{ $nama_ayah }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" wire:model="id_keluarga">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" wire:model="tanggal_lahir">
                            @error('tanggal_lahir')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <select class="form-control" wire:model="jk">
                                <option>Pilih</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jk')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" wire:click.prevent="edit_anak()">Save
                            changes</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
