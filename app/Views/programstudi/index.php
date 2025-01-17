<?= $this->extend('layouts/page_layout') ?>
<?= $this->section('content') ?>
        <div class="right_col" role="main" style="min-height: 3790px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Program Studi</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="myTable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info" style="width:100%">
                            <thead>
                              <tr role="row">
                                <th>Nama</th>
                                <th>Program Pendidikan</th>
                                <th>Akreditasi</th>
                                <th>SK Akreditasi</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <script src="<?= base_url('vendors');?>/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('vendors');?>/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

        <script>
          $(document).ready( function () {
            let myTable = $('#myTable').DataTable({
              dom: 'Bfrtip',
              buttons: [
                  {
                      text: '<button>Add New Program Studi</button>',
                      action: function ( e, dt, node, config ) {
                        window.location = "/create";
                      }
                  }
              ],
              'processing': true,
              'serverSide': true,
              'serverMethod': 'get',
              ajax: {
                  url: '<?= base_url("api/programstudi");?>',
                  dataSrc: 'data'
              },
              columns: [
                { data: 'nama' },
                { data: 'program_pendidikan' },
                { data: 'akreditasi'},
                { data: 'sk_akreditasi'},
                {
                    data: null,
                    defaultContent: '<i data-type="update" class="fa fa-pencil-square-o" aria-hidden="true"></i> <i data-type="delete" class="fa fa-trash-o" aria-hidden="true"></i>',
                    targets: -1
                },
              ],
              "ordering":true,
              order: [] ,
            });

            myTable.on('click', 'i', function (e) {
              let action = e.target.getAttribute('data-type');
              let id = e.target.parentNode.parentElement.getAttribute("id");
              if (action === "update" ) {
                window.location = "<?= base_url('programstudi');?>/"+id+"/update"; 
              } else if (action === "delete") {
                if (confirm("Yakin ingin menghapus data # " + id)) {
                  $.ajax({
                    url: "<?= base_url('programstudi');?>/"+id+"/delete",
                    method: "POST",
                    success: function() {
                        myTable.ajax.reload();
                    }
                  });
                }
              }
            });
          } );
        </script>
<?= $this->endSection() ?>