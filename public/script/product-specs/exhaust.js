export const exhaustSpecs = `
 <h5>Exhaust & Muffler</h5>
 <div class="row g-3 mb-2">
     <div class="col-md-6">
         <label>Exhaust Material</label>
         <select name="exhaust_material" class="form-select">
             <option value="">Select</option>
             <option value="Steel">Steel</option>
             <option value="Stainless Steel">Stainless Steel</option>
             <option value="Titanium">Titanium</option>
             <option value="Carbon Fiber">Carbon Fiber</option>
             <option value="Aluminum">Aluminum</option>
             <option value="Other">Other</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Pipe Diameter (mm)</label>
         <input type="number" name="pipe_diameter" class="form-control" placeholder="e.g. 32">
     </div>
     <div class="col-md-6">
         <label>Muffler Type</label>
         <select name="muffler_type" class="form-select">
             <option value="">Select</option>
             <option value="Standard / OEM">Standard / OEM</option>
             <option value="Slip-On">Slip-On</option>
             <option value="Full System">Full System</option>
             <option value="Sport">Sport</option>
             <option value="Aftermarket">Aftermarket</option>
             <option value="Custom">Custom</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Sound Level (dB)</label>
         <input type="number" name="sound_level" class="form-control" placeholder="e.g. 85">
     </div>
     <div class="col-md-6">
         <label>Header Material</label>
         <select name="header_material" class="form-select">
             <option value="">Select</option>
             <option value="Steel">Steel</option>
             <option value="Stainless Steel">Stainless Steel</option>
             <option value="Titanium">Titanium</option>
             <option value="Chromed Steel">Chromed Steel</option>
             <option value="Other">Other</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Exhaust Configuration</label>
         <select name="exhaust_config" class="form-select">
             <option value="">Select</option>
             <option value="1-1">1-1 (Single)</option>
             <option value="2-1">2-1</option>
             <option value="4-1">4-1</option>
             <option value="4-2-1">4-2-1</option>
             <option value="Dual Exhaust">Dual Exhaust</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Noise Reduction / Silencer</label>
         <select name="has_silencer" class="form-select">
             <option value="">Select</option>
             <option value="Yes">Yes</option>
             <option value="No">No</option>
             <option value="Removable Baffle">Removable Baffle</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Emission Compliance</label>
         <select name="emission_compliance" class="form-select">
             <option value="">Select</option>
             <option value="Euro 2">Euro 2</option>
             <option value="Euro 3">Euro 3</option>
             <option value="Euro 4">Euro 4</option>
             <option value="Euro 5">Euro 5</option>
             <option value="None / Race Use">None / Race Use</option>
         </select>
     </div>
 </div>
`;
