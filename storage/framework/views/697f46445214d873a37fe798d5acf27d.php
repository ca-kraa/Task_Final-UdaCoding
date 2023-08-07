<?php echo $__env->make('atribut.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('atribut.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="wrapper">
    <?php echo $__env->make('atribut.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Satuan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Satuan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Satuan Unit</h3>
                <div class="float-right">

                    <button id="refreshButton" class="btn btn-primary">
                        <i class=" fas fa-arrows-rotate"></i> Refresh</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#tambahSatuanModal">
                        <i class="fas fa-plus"></i> Create
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="satuan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="bg-success text-center">Satuan Unit</th>
                            <th class="bg-success text-center">Deskripsi</th>
                            <th class="bg-success text-center">Status</th>
                            <th class="bg-success text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $satuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($satuan->satuan_unit); ?></td>
                            <td class="text-center"><?php echo e($satuan->deskripsi); ?></td>
                            <td class="text-center">
                                <?php if($satuan->status == 'Aktif'): ?>
                                <a href="<?php echo e(route('satuan.nonaktif', $satuan->id)); ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-check-circle"></i> Aktif
                                </a>
                                <?php else: ?>
                                <a href="<?php echo e(route('satuan.aktif', $satuan->id)); ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times-circle"></i> Nonaktif
                                </a>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#detailEditModal<?php echo e($satuan->id); ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#deleteModal<?php echo e($satuan->id); ?>" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo e($satuan->id); ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Satuan Unit</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="tambahSatuanModal" tabindex="-1" role="dialog" aria-labelledby="tambahSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSatuanModalLabel">Tambah Satuan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('satuan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="satuan_unit">Satuan Unit</label>
                        <input type="text" class="form-control" id="satuan_unit" name="satuan_unit" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                    </div>
                    <input type="hidden" name="status" value="Aktif">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__currentLoopData = $satuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="deleteModal<?php echo e($satuan->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($satuan->id); ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?php echo e($satuan->id); ?>">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-triangle text-warning" style="font-size 48px;"></i>
                    </div>
                    <p>Anda yakin ingin menghapus data ini secara permanen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteForm<?php echo e($satuan->id); ?>" action="<?php echo e(route('satuan.destroy', $satuan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">
                         Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <?php $__currentLoopData = $satuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Modal Detail & Edit -->
    <div class="modal fade" id="detailEditModal<?php echo e($satuan->id); ?>" tabindex="-1" aria-labelledby="detailEditModalLabel<?php echo e($satuan->id); ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailEditModalLabel<?php echo e($satuan->id); ?>">Detail dan Edit Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('satuan.update', $satuan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <label for="satuan_unit">Satuan Unit</label>
                            <input type="text" class="form-control" id="satuan_unit" name="satuan_unit" value="<?php echo e($satuan->satuan_unit); ?>">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo e($satuan->deskripsi); ?>">
                        </div>
                        <input type="hidden" name="status" value="<?php echo e($satuan->status); ?>">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        <?php echo $__env->make('atribut.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\UdaCoding\Codingan\Task 9\laundryy\resources\views/satuan/index.blade.php ENDPATH**/ ?>