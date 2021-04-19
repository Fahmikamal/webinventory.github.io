<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> Barang Keluar </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" href="ff.png" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">
                <img src="assets/log.png" width="220px" alt="">
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
           
            <!-- Navbar-->
            
        </nav>
        <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Selamat Datang</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                                Logout 
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4 mb-3">Barang Keluar</h1>


                        <div class="card mb-4">
                            <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama SKU</th>
                                                <th>Jumlah</th>
                                                <th>Penerima</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                             $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang =k.idbarang");
                                             while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $idk =$data['idkeluar'];
                                                $idb =$data['idbarang'];
                                                $tanggal =$data['tanggal'];
                                                $namasku = $data['namasku'];
                                                $qty = $data['qty'];
                                                $penerima = $data['penerima'];
                                                

                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$namasku;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$penerima;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                    Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idk;?>">
                                                    Delete
                                                    </button>
                                                </td>
                                            </tr> 

                                             <!-- The edit Modal -->
                                             <div class="modal fade" id="edit<?=$idk;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    <label for="penerima">Penerima</label>
                                                    <input type="text" name="penerima" value="<?=$penerima;?>" class="form-control" required>
                                                    <br>
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="text" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                    <br>
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <input type="hidden" name="idk" value="<?=$idk;?>">
                                                    <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                                                    </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>

                                            <!--Delete modal-->
                                            <div class="modal fade" id="delete<?=$idk;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                    <div class="modal-body">
                                                    Apakah Kamu yakin ingin menghapus <?=$namasku;?>?
                                                    <input type="hidden" name="idb" value="<?=$idb;?>">
                                                    <input type="hidden" name="kty" value="<?=$qty;?>">
                                                    <input type="hidden" name="idk" value="<?=$idk;?>">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger" name="hapusbarangkeluar">Hapus</button>
                                                    </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>

                                            <?php
                                             };
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a href="https://muezzacorp.com/">CV.Muezzacorp.com 2020</a></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tambah Barang</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
            <select name="barangnya" class="form-control">
                <?php
                    $ambilsemuadatanya = mysqli_query($conn,"select * from stock");
                    while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                        $namabarangnya = $fetcharray['namasku'];
                        $idbarangnya = $fetcharray['idbarang'];
                ?>            

                <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>


                <?php
                    }
                ?>


            </select>
            <br>
            <label for="quantity">Quantity</label>
            <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
            <br>
            <label for="Penerima">Penerima</label>
            <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="addbarangkeluar">Submit</button>
            </div>
            </form>
            
        </div>
        </div>
    </div>
    
    
</html>
