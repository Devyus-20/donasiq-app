@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h2>Dashboard Keuangan</h2>
    <p>Menu khusus untuk bagian keuangan:</p>
    <div class="list-group">
      <a href="{{ url('/finance/bank-mutations/upload') }}" class="list-group-item list-group-item-action">
        ⬆️ Upload Mutasi Bank
      </a>
      <a href="{{ url('/finance/bank-mutations') }}" class="list-group-item list-group-item-action">
        🔍 Validasi Mutasi & Cocokkan Donasi
      </a>
      <a href="#" class="list-group-item list-group-item-action">
        💵 Terima Setoran Cash dari CRM
      </a>
    </div>
  </div>
</div>
@endsection
