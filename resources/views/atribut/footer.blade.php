<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="{{ asset('assets/AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/chart.js/Chart.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/sparklines/sparkline.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/daterangepicker/daterangepicker.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/summernote/summernote-bs4.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/dist/js/adminlte.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/dist/js/demo.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/dist/js/pages/dashboard.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/AdminLTE') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
$(document).ready(function () {
    var table1 = $("#paket").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-success',
                text: '<i class="fas fa-file-excel"></i> Excel'
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger',
                text: '<i class="fas fa-file-pdf"></i> PDF'
            }
        ]
    });

    table1.buttons().container().appendTo('#paket_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        paging: true,
        lengthChange: true,
        searching: false,
        ordering: true,
        lengthMenu: [10, 25, 50, 100],
        info: true,
        autoWidth: false,
        responsive: true
    });

    var satuanTable = $('#satuan').DataTable({
        paging: true,
        lengthChange: true,
        lengthMenu: [10, 25, 50, 100],
        searching: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true
    });

        $('#tambahForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('satuan.store') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#tambahModal').modal('hide');
                    table.ajax.reload();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
});

</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const submitButton = document.getElementById("submitButton");
      const inputForm = document.getElementById("inputForm");

      submitButton.addEventListener("click", function () {
          inputForm.submit();
      });
  });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editModalBtns = document.querySelectorAll(".edit-modal-btn");
        const editModal = document.getElementById("editModal");
        const editForm = document.getElementById("editForm");
        const editSatuanUnit = document.getElementById("edit_satuan_unit");
        const editDeskripsi = document.getElementById("edit_deskripsi");
        const simpanEditBtn = document.getElementById("simpanEdit");

        $('#submitButton').on('click', function () {
            $(this).prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: $('#inputForm').attr('action'),
                data: $('#inputForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    $('#satuan_unit').val('');
                    $('#deskripsi').val('');
                    $('#status').val('aktif');
                    $('#inputModal').modal('hide');

                    $('#submitButton').prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('#submitButton').prop('disabled', false);
                }
            });
        });

        editModalBtns.forEach(btn => {
            btn.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                fetch(`/satuan/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        editSatuanUnit.value = data.satuan_unit;
                        editDeskripsi.value = data.deskripsi;
                        editForm.action = `/satuan/update/${data.id}`;
                        simpanEditBtn.setAttribute("data-id", data.id);
                        $(editModal).modal("show");
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                    });
            });
        });
    });
</script>

<script>
    document.getElementById('refreshButton').addEventListener('click', function() {
        location.reload();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const fromDateInput = document.getElementById('fromDate');
        const toDateInput = document.getElementById('toDate');

        filterForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const fromDateString = fromDateInput.value;
            const toDateString = toDateInput.value;

            const url = "{{ route('paket.index') }}?from_date=" + fromDateString + "&to_date=" + toDateString;

            window.location.href = url;
        });
    });
</script>

</body>
</html>
