 <!-- /.content-wrapper -->
 <footer class="main-footer">
     <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
     All rights reserved.
     <div class="float-right d-none d-sm-inline-block">
         <b>Version</b> 3.2.0
     </div>
 </footer>

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
     <!-- Control sidebar content goes here -->
 </aside>
 <!-- /.control-sidebar -->
 </div>
 <!-- ./wrapper -->

 <!-- jQuery -->
 <script src="/assets/plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
     $.widget.bridge('uibutton', $.ui.button)
 </script>
 <!-- Bootstrap 4 -->
 <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- ChartJS -->
 <script src="/assets/plugins/chart.js/Chart.min.js"></script>
 <!-- Sparkline -->
 <script src="/assets/plugins/sparklines/sparkline.js"></script>
 <!-- JQVMap -->
 <script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
 <script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
 <!-- jQuery Knob Chart -->
 <script src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
 <!-- daterangepicker -->
 <script src="/assets/plugins/moment/moment.min.js"></script>
 <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 <!-- Summernote -->
 <script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- DataTables  & Plugins -->
 <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
 <script src="/assets/plugins/jszip/jszip.min.js"></script>
 <script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
 <script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
 <script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
 <script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
 <script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
 <!-- AdminLTE App -->
 <script src="/assets/dist/js/adminlte.js"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="/assets/dist/js/pages/dashboard.js"></script>
 <script>
     $(function() {
         $("#example1").DataTable({
             "responsive": true,
             "lengthChange": false,
             "autoWidth": false,
             "buttons": ["csv", "excel", "pdf", "print"]
         }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
         $('#example2').DataTable({
             "paging": true,
             "lengthChange": false,
             "searching": false,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "responsive": true,
         });
         $('#example3').DataTable({
             "paging": true,
             "lengthChange": false,
             "searching": false,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "responsive": true,
         });
         $('#example4').DataTable({
             "paging": true,
             "lengthChange": false,
             "searching": false,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "responsive": true,
         });
     });
 </script>

 <script>
     function updateNavbar(url, countId, listId, iconClass) {
         fetch(url)
             .then(res => res.json())
             .then(data => {
                 document.getElementById(countId).innerText = data.count;

                 let list = document.getElementById(listId);
                 list.innerHTML = `<span class="dropdown-item dropdown-header">${listId.replace('List','')}</span><div class="dropdown-divider"></div>`;

                 data.items.forEach(item => {
                     list.innerHTML += `
                <a href="#" class="dropdown-item">
                    <i class="${iconClass} mr-2"></i> ${item.name || item.product_name || item.note}
                    <span class="float-right text-muted text-sm">${item.received_at || item.purchase_date || item.issued_at}</span>
                </a>
                <div class="dropdown-divider"></div>
            `;
                 });
             });
     }

     // Update setiap 10 detik
     setInterval(() => {
         updateNavbar('/incoming-item/navbar', 'incomingCount', 'incomingList', 'fas fa-box');
         updateNavbar('/purchase-item/navbar', 'purchaseCount', 'purchaseList', 'fas fa-cart-plus');
         updateNavbar('/outgoing-item/navbar', 'outgoingCount', 'outgoingList', 'fas fa-truck');
     }, 10000);

     // Load pertama kali
     updateNavbar('/incoming-item/navbar', 'incomingCount', 'incomingList', 'fas fa-box');
     updateNavbar('/purchase-item/navbar', 'purchaseCount', 'purchaseList', 'fas fa-cart-plus');
     updateNavbar('/outgoing-item/navbar', 'outgoingCount', 'outgoingList', 'fas fa-truck');
 </script>

 <!-- DataTables Script -->
 <!-- DataTables + Tab Active Script -->
 <script>
     $(document).ready(function() {
         // DataTables init
         $('#incomingReport, #outgoingReport, #stockReport').DataTable({
             responsive: true,
             autoWidth: false,
             ordering: true,
             paging: true,
             searching: true,
             lengthChange: true,
             pageLength: 10
         });

         // Simpan tab terakhir aktif ke localStorage
         $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
             localStorage.setItem('activeTab', $(e.target).attr('href'));
         });

         // Set tab aktif saat reload
         var activeTab = localStorage.getItem('activeTab');
         if (activeTab) {
             $('#report-tabs a[href="' + activeTab + '"]').tab('show');
         }
     });
 </script>

 <script>
     const emptyStockProducts = [
         <?php if (isset($emptyStockProducts)) :
                foreach ($emptyStockProducts as $p) :
                    echo "{name: '" . esc($p['name']) . "'},";
                endforeach;
            endif; ?>
     ];

     const alertCount = document.getElementById('stockAlertCount');
     const alertList = document.getElementById('stockAlertList');

     if (emptyStockProducts.length > 0) {
         alertCount.textContent = emptyStockProducts.length;
         emptyStockProducts.forEach(p => {
             const item = document.createElement('a');
             item.href = "<?= base_url('/products') ?>"; // link ke halaman produk
             item.classList.add('dropdown-item');
             item.innerHTML = `<i class="fas fa-exclamation-circle mr-2 text-danger"></i> ${p.name} stok kosong`;
             alertList.appendChild(item);
             const divider = document.createElement('div');
             divider.classList.add('dropdown-divider');
             alertList.appendChild(divider);
         });
     } else {
         alertCount.textContent = 0;
         const item = document.createElement('span');
         item.classList.add('dropdown-item');
         item.textContent = 'Tidak ada stok kosong';
         alertList.appendChild(item);
     }
 </script>
 <!-- Tambahkan SweetAlert -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     <?php if (session()->getFlashdata('success')): ?>
         Swal.fire({
             icon: 'success',
             title: 'Berhasil!',
             text: '<?= session()->getFlashdata('success') ?>',
             showConfirmButton: false,
             timer: 2000
         });
     <?php endif; ?>

     <?php if (session()->getFlashdata('error')): ?>
         Swal.fire({
             icon: 'error',
             title: 'Gagal!',
             text: '<?= session()->getFlashdata('error') ?>',
             showConfirmButton: true
         });
     <?php endif; ?>
 </script>
 </body>

 </html>