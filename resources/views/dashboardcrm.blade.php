@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h2>Dashboard CRM / Fundraiser</h2>
    <p>Menu khusus untuk fundraiser:</p>
    <div class="list-group">
      <a href="{{ url('/crm/donations/create') }}" class="list-group-item list-group-item-action">
        ➕ Input Donasi Cash/Transfer
      </a>
      <a href="{{ url('/crm/donations') }}" class="list-group-item list-group-item-action">
        📋 Daftar Donasi Saya
      </a>
      <a href="#" class="list-group-item list-group-item-action">
        ✅ Validasi Transfer Donatur
      </a>
    </div>
  </div>
</div>
@endsection
