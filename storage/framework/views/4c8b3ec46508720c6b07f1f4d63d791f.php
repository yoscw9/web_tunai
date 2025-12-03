<?php
use App\Helpers\Formatter;
?>



<?php $__env->startSection('title', 'Tunai | Beranda'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            
            <div class="col-md-6">
                <div>
                    <div class="sec-title">
                        <h5>Makanan</h5>
                    </div>
                    <hr>
                    
                    <div>
                        <div class="bst-items">
                            <?php $__currentLoopData = $makanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mkn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bst-box d-flex">
                                    <div class="bst-img">
                                        <img src="<?php echo e(asset('XeMart/images/sbar-1.png')); ?>" alt="" class="img-fluid">
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="bst-content">
                                        <p><?php echo e($mkn->nama_menu); ?></p>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item">
                                                <b><?php echo e(Formatter::moneyFormat($mkn->harga)); ?></b>
                                            </li>
                                        </ul><br>
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="menu_id" value="<?php echo e($mkn->menu_id); ?>">
                                            <input type="number" name="quantity" value="1" min="1" hidden>
                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                        </form>
                                    </div>
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div>
                    <div class="sec-title">
                        <h5>Minuman</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="bst-items">
                            <?php $__currentLoopData = $minuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mnm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bst-box d-flex">
                                    <div class="bst-img">
                                        <img src="<?php echo e(asset('XeMart/images/sbar-9.png')); ?>" alt="" class="img-fluid">
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="bst-content">
                                        <p><?php echo e($mnm->nama_menu); ?></p>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item">
                                                <b><?php echo e(Formatter::moneyFormat(value: $mnm->harga)); ?></b>
                                            </li>
                                        </ul><br>
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="menu_id" value="<?php echo e($mnm->menu_id); ?>">
                                            <input type="number" name="quantity" value="1" min="1" hidden>
                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                        </form>
                                    </div>
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div>
                    <div class="sec-title">
                        <h5>Snack</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="bst-items">
                            <?php $__currentLoopData = $snack; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $snck): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bst-box d-flex">
                                    <div class="bst-img">
                                        <img src="<?php echo e(asset('XeMart/images/sbar-7.png')); ?>" alt="" class="img-fluid">
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="bst-content">
                                        <p><?php echo e($snck->nama_menu); ?></p>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item"><b><?php echo e(Formatter::moneyFormat($snck->harga)); ?></b></li>
                                        </ul><br>
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="menu_id" value="<?php echo e($snck->menu_id); ?>">
                                            <input type="number" name="quantity" value="1" min="1" hidden>
                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                        </form>
                                    </div>
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div>
                    <div class="sec-title">
                        <h5>Topping</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="bst-items">
                            <?php $__currentLoopData = $topping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bst-box d-flex">
                                    <div class="bst-img">
                                        <img src="<?php echo e(asset('XeMart/images/sbar-7.png')); ?>" alt="" class="img-fluid">
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="bst-content">
                                        <p><?php echo e($top->nama_menu); ?></p>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item"><b><?php echo e(Formatter::moneyFormat($top->harga)); ?></b></li>
                                        </ul><br>
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="menu_id" value="<?php echo e($top->menu_id); ?>">
                                            <input type="number" name="quantity" value="1" min="1" hidden>
                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                        </form>
                                    </div>
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div>
                    <div class="sec-title">
                        <h5>Rempeyek Renyah</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="bst-items">
                            <?php $__currentLoopData = $rempeyek; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ryk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bst-box d-flex">
                                    <div class="bst-img">
                                        <img src="<?php echo e(asset('XeMart/images/sbar-7.png')); ?>" alt="" class="img-fluid">
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="bst-content">
                                        <p><?php echo e($ryk->nama_menu); ?></p>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item"><b><?php echo e(Formatter::moneyFormat($ryk->harga)); ?></b></li>
                                        </ul><br>
                                        <form action="" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="menu_id" value="<?php echo e($ryk->menu_id); ?>">
                                            <input type="number" name="quantity" value="1" min="1" hidden>
                                            <button type="submit" class="btn btn-primary">Pesan</button>
                                        </form>
                                    </div>
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div>
                    <div class="sec-title">
                        <h5>Paket</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="bst-items">
                            <?php $__currentLoopData = $paket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bst-box d-flex">
                                    <div class="bst-img">
                                        <img src="<?php echo e(asset('XeMart/images/sbar-7.png')); ?>" alt="" class="img-fluid">
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="bst-content">
                                        <p><?php echo e($pkt->nama_paket); ?></p>
                                        <ul class="list-unstyled list-inline">
                                            <?php $__currentLoopData = $paketMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pktm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-inline-item" style="font-style: italic"><?php echo e($pktm->nama_menu); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <br>
                                            <li class="list-inline-item">
                                                <b><?php echo e(Formatter::moneyFormat($pkt->harga)); ?></b>
                                            </li>
                                            <form action="" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="menu_id" value="<?php echo e($pkt->package_id); ?>">
                                                <input type="number" name="quantity" value="1" min="1" hidden>
                                                <button type="submit" class="btn btn-primary">Pesan</button>
                                            </form>
                                        </ul>
                                    </div>
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div>
                    <div class="sec-title">
                        <h5>Promo</h5>
                    </div>
                    <hr>
                    <div>
                        <div class="bst-items">
                            <?php $__currentLoopData = $promo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bst-box d-flex">
                                    <div class="bst-img">
                                        <img src="<?php echo e(asset('XeMart/images/sbar-7.png')); ?>" alt="" class="img-fluid">
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="bst-content">
                                        <p><?php echo e($prm->nama_promo); ?></p>
                                        <ul class="list-unstyled list-inline">
                                            <?php $__currentLoopData = $promoMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prmm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-inline-item" style="font-style: italic"><?php echo e($prmm->nama_menu); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <br>
                                            <li class="list-inline-item">
                                                <b><?php echo e(Formatter::moneyFormat($prm->harga)); ?></b>
                                            </li>
                                            <form action="" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="menu_id" value="<?php echo e($prm->promo_id); ?>">
                                                <input type="number" name="quantity" value="1" min="1" hidden>
                                                <button type="submit" class="btn btn-primary">Pesan</button>
                                            </form>
                                        </ul>
                                    </div>
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tunai_app\resources\views/customer/index.blade.php ENDPATH**/ ?>