<div>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">products</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">products</li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">products Table</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">






    
    {{-- add new product --}}
    <button wire:click.prevent="createProduct"  type="button" class="btn btn-primary" >
       <i class="fa fa-plus"></i> Add new product
    </button>

    <!-- Modal -->
    <div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="addNewProductLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">

            @if ($action == 'add')

                @livewire('admin.dashboard.products.create-product')
                
            @elseif ($action == 'edit')

                @livewire('admin.dashboard.products.edit-product',['product' => $product] , key($product->id))
                {{-- @include('admin.dashboard.products._edit_modal')  --}}
                
            @elseif ($action == 'delete')

                @include('admin.dashboard.products._delete_modal')                
            
            @endif

        </div>
    </div>

    
    {{-- products table --}}
    <table class="table table-bordered table-responsive-sm">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>name</th>
                <th>description</th>
                <th>price</th>
                <th>photo</th>
                <th>Action</th>
            </tr>
          
        </thead>
        <tbody>
           
            @if ($products->count() > 0)

                @foreach ($products as $table_index => $product)

                    @include('admin.dashboard.products.product-row')


                @endforeach

                {{-- {{ $products->links() }} --}}

            @else
            <tr>
                <td colspan="7"><p> there is not data</p></td>
            </tr>

            @endif



        </tbody>
    </table>







            

</div>
<!-- /.card-body -->


<!-- .card-footer -->
<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
    </ul>
</div>
<!-- /.card-footer -->


</div>
<!-- /.card -->


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
