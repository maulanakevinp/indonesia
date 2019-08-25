<?php

namespace Laravolt\Indonesia\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravolt\Indonesia\Http\Requests\Provinsi\Store;
use Laravolt\Indonesia\Http\Requests\Provinsi\Update;
use Laravolt\Indonesia\Models\Provinsi;
use Laravolt\Indonesia\Tables\ProvinsiTable;
use Laravolt\Suitable\Builder;
use Laravolt\Suitable\Toolbars\Action;

class ProvinsiController extends Controller
{
    public function index()
    {
        $data = Provinsi::autoSort()->autoFilter()->search(request('search'))->paginate();

        return (new ProvinsiTable($data))
            ->title(__('Daftar Provinsi'))
            ->view('indonesia::provinsi.index');
    }

    public function create()
    {
        return view('indonesia::provinsi.create');
    }

    public function store(Store $request)
    {
        Provinsi::create($request->validated());

        return redirect()->route('indonesia::provinsi.index')->withSuccess('Provinsi saved');
    }

    public function edit(Provinsi $provinsi)
    {
        return view('indonesia::provinsi.edit', compact('provinsi'));
    }

    public function update(Update $request, Provinsi $provinsi)
    {
        $provinsi->update($request->validated());

        return redirect()->back()->withSuccess('Provinsi saved');
    }

    public function destroy(Provinsi $provinsi)
    {
        $provinsi->delete();

        return redirect()->route('indonesia::provinsi.index')->withSuccess('Provinsi deleted');
    }
}