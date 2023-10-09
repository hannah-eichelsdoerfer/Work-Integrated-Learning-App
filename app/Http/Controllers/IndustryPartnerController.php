<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IndustryPartner;

class IndustryPartnerController extends Controller
{
    public function index()
    {
        $industryPartners = IndustryPartner::where('approved', true)->orderBy('name')->paginate(5);
        return view('industry-partners.index')->with('industryPartners', $industryPartners);
    }

    public function show($id)
    {
        $industryPartner = IndustryPartner::find($id);
        
        return view('industry-partners.show')->with('industryPartner', $industryPartner);
    }

    public function update($id)
    {
        $industryPartner = IndustryPartner::find($id);
        $industryPartner->approved = true;
        $industryPartner->save();
        return redirect()->route('industry-partners.index');
    }
}
