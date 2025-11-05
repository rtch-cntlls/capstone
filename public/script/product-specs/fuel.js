export const fuelSpecs = `
 <h5>Fuel System</h5>
 <div class="row g-3 mb-2">
     <div class="col-md-6">
         <label>Fuel Delivery Type</label>
         <select name="fuel_delivery" class="form-select">
             <option value="">Select</option>
             <option value="Carburetor">Carburetor</option>
             <option value="Fuel Injection (FI)">Fuel Injection (FI)</option>
             <option value="EFI (Electronic Fuel Injection)">EFI (Electronic Fuel Injection)</option>
             <option value="Direct Injection">Direct Injection</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Fuel Tank Capacity (L)</label>
         <input type="number" step="0.1" name="fuel_tank_capacity" class="form-control" placeholder="e.g. 4.2">
     </div>
     <div class="col-md-6">
         <label>Fuel Filter Type</label>
         <select name="fuel_filter" class="form-select">
             <option value="">Select</option>
             <option value="Paper">Paper</option>
             <option value="Mesh">Mesh</option>
             <option value="Inline">Inline</option>
             <option value="Integrated">Integrated</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Fuel Pump Type</label>
         <select name="fuel_pump" class="form-select">
             <option value="">Select</option>
             <option value="Mechanical">Mechanical</option>
             <option value="Electric">Electric</option>
             <option value="Vacuum">Vacuum</option>
             <option value="Inline Electric">Inline Electric</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Fuel Type</label>
         <select name="fuel_type" class="form-select">
             <option value="">Select</option>
             <option value="Gasoline">Gasoline</option>
             <option value="Ethanol Blend">Ethanol Blend</option>
             <option value="Diesel">Diesel</option>
             <option value="Race Fuel">Race Fuel</option>
             <option value="Other">Other</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Fuel Octane Rating</label>
         <select name="octane_rating" class="form-select">
             <option value="">Select</option>
             <option value="91 RON">91 RON</option>
             <option value="95 RON">95 RON</option>
             <option value="97 RON">97 RON</option>
             <option value="100+ RON">100+ RON</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Carburetor / Injector Size (mm)</label>
         <input type="number" step="0.1" name="injector_size" class="form-control" placeholder="e.g. 28">
     </div>
     <div class="col-md-6">
         <label>Fuel Line Diameter (mm)</label>
         <input type="number" step="0.1" name="fuel_line_diameter" class="form-control" placeholder="e.g. 6">
     </div>
     <div class="col-md-6">
         <label>Reserve Fuel Capacity (L)</label>
         <input type="number" step="0.1" name="reserve_capacity" class="form-control" placeholder="e.g. 1.0">
     </div>
 </div>
`;
