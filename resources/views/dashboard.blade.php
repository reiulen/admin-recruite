<x-app-layout title="Dashboard">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center py-5">
              <div class="col-12">
                    <h4>Data Job Application</h4>
                    <div class="card card-outline mt-4">
                        <!-- /.card-header -->
                        <div class="card-body over">
                            <div class="overflow-auto">
                                <table id="example1" class="table table-bordered  table-hover">
                                    <thead>
                                    <tr class="text-center">
                                        <th rowspan="2" width="10px">No</th>
                                        <th class="text-nowrap">Name</th>
                                        <th class="text-nowrap">Email</th>
                                        <th class="text-nowrap">Phone</th>
                                        <th class="text-nowrap">Hear About Us</th>
                                        <th class="text-nowrap">Submitted At</th>
                                        <th rowspan="2">Action</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th class="text-nowrap" style="min-width: 180px">
                                            <input name="name" class="form-control" />
                                        </th>
                                        <th class="text-nowrap" style="min-width: 180px">
                                            <input name="email" class="form-control" />
                                        </th>
                                        <th class="text-nowrap" style="min-width: 180px">
                                            <input name="phone" type="number" class="form-control" />
                                        </th>
                                        <th class="text-nowrap" style="min-width: 180px">
                                            <select class="form-control" name="hear_about_us" id="test">
                                                <span class="caret"></span>
                                                <option value="" disabled selected>Select</option>
                                                <option class="non" value="Professional Recommendation">Professional Recommendation</option>
                                                <option class="non" value="Google">Google</option>
                                                <option class="non" value="LinkedIn">LinkedIn</option>
                                                <option class="non" value="Networking">Networking</option>
                                                <option class="editable" value="Other">Other</option>
                                            </select>
                                        </th>
                                        <th class="text-nowrap" style="min-width: 180px">
                                            <input name="submitted_at" type="date" class="form-control" />
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                  <!-- /.card -->
              </div>
              <!-- /.col -->
              </div>
              <!-- /.row -->
          </div>
    </section>
    <!-- /.content -->
    @push('modals')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content" style="border-radius: 20px; border: 0 !important; box-shadow: none !important">
                <div class="d-flex align-items-center p-4 justify-content-between">
                    <h4 class="modal-title" id="modalDetailLabel">Detail</h4>
                    <div class="d-flex align-items-center" style="gap: 8px">
                        <div class="full-size" role="button" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body px-4 pb-5" id="modalDetailBody">

                </div>
            </div>
        </div>
    </div>
    @endpush
    @include('lib.datatable')
    @push('script')
    <script src="{{ asset('assets/dist/js/pages/job-application/index.js') }}"></script>
    @endpush
</x-app-layout>
