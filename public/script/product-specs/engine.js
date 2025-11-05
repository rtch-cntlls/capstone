export const engineSpecs = `
 <h5>Engine Specs</h5>
 <div class="row g-3 mb-2">
     <div class="col-md-6">
         <label>Engine Type</label>
         <select name="engine_type" class="form-select">
             <option value="">Select</option>
             <option value="Single Cylinder">Single Cylinder</option>
             <option value="Parallel Twin">Parallel Twin</option>
             <option value="V-Twin">V-Twin</option>
             <option value="Inline 3">Inline 3</option>
             <option value="Inline 4">Inline 4</option>
             <option value="Boxer">Boxer</option>
             <option value="Other">Other</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Displacement (cc)</label>
         <input type="number" name="displacement" class="form-control" placeholder="e.g. 150">
     </div>
     <div class="col-md-6">
         <label>Number of Valves</label>
         <select name="valves" class="form-select">
             <option value="">Select</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5+">5+</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Valve System</label>
         <select name="valve_system" class="form-select">
             <option value="">Select</option>
             <option value="SOHC">SOHC</option>
             <option value="DOHC">DOHC</option>
             <option value="OHV">OHV</option>
             <option value="Pushrod">Pushrod</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Power / Output (hp)</label>
         <input type="number" name="power_output" class="form-control" placeholder="e.g. 15">
     </div>
     <div class="col-md-6">
         <label>Torque (Nm)</label>
         <input type="number" name="torque" class="form-control" placeholder="e.g. 13">
     </div>
     <div class="col-md-6">
         <label>Compression Ratio</label>
         <input type="text" name="compression_ratio" class="form-control" placeholder="e.g. 10.5:1">
     </div>
     <div class="col-md-6">
         <label>Cooling Type</label>
         <select name="engine_cooling" class="form-select">
             <option value="">Select</option>
             <option value="Air Cooled">Air Cooled</option>
             <option value="Liquid Cooled">Liquid Cooled</option>
             <option value="Oil Cooled">Oil Cooled</option>
             <option value="Air + Oil">Air + Oil</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Fuel Type</label>
         <select name="fuel_type" class="form-select">
             <option value="">Select</option>
             <option value="Gasoline">Gasoline</option>
             <option value="Diesel">Diesel</option>
             <option value="Ethanol Blend">Ethanol Blend</option>
             <option value="Hybrid">Hybrid</option>
             <option value="Other">Other</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Starter Type</label>
         <select name="starter_type" class="form-select">
             <option value="">Select</option>
             <option value="Electric">Electric</option>
             <option value="Kick">Kick</option>
             <option value="Both">Both</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Ignition Type</label>
         <select name="ignition_type" class="form-select">
             <option value="">Select</option>
             <option value="CDI">CDI</option>
             <option value="TCI">TCI</option>
             <option value="ECU (Fuel Injected)">ECU (Fuel Injected)</option>
             <option value="Magneto">Magneto</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Bore x Stroke (mm)</label>
         <input type="text" name="bore_stroke" class="form-control" placeholder="e.g. 57.3 x 57.8">
     </div>
     <div class="col-md-6">
         <label>Engine Oil Capacity (L)</label>
         <input type="number" step="0.1" name="oil_capacity" class="form-control" placeholder="e.g. 1.0">
     </div>
 </div>
`;
