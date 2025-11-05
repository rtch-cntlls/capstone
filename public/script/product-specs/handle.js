export const handlebarsSpecs = `
 <h5>Controls & Handlebars</h5>
 <div class="row g-3 mb-2">
     <div class="col-md-6">
         <label>Handlebar Type</label>
         <select name="handlebar_type" class="form-select">
             <option value="">Select</option>
             <option value="Standard / OEM">Standard / OEM</option>
             <option value="Clip-On">Clip-On</option>
             <option value="Ape Hanger">Ape Hanger</option>
             <option value="Drag Bar">Drag Bar</option>
             <option value="Motocross">Motocross</option>
             <option value="Café Racer">Café Racer</option>
             <option value="Tracker / Flat Bar">Tracker / Flat Bar</option>
             <option value="Riser Bar">Riser Bar</option>
             <option value="Other">Other</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Material</label>
         <select name="handlebar_material" class="form-select">
             <option value="">Select</option>
             <option value="Steel">Steel</option>
             <option value="Aluminum Alloy">Aluminum Alloy</option>
             <option value="Carbon Fiber">Carbon Fiber</option>
             <option value="Chromed Steel">Chromed Steel</option>
             <option value="Other">Other</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Handlebar Diameter (mm)</label>
         <input type="number" name="handlebar_diameter" class="form-control" placeholder="e.g. 22 or 28.6">
     </div>
     <div class="col-md-6">
         <label>Handlebar Width (mm)</label>
         <input type="number" name="handlebar_width" class="form-control" placeholder="e.g. 720">
     </div>
     <div class="col-md-6">
         <label>Control Type</label>
         <select name="control_type" class="form-select">
             <option value="">Select</option>
             <option value="Mechanical">Mechanical</option>
             <option value="Hydraulic">Hydraulic</option>
             <option value="Electronic">Electronic</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Control Features</label>
         <input type="text" name="control_features" class="form-control" placeholder="e.g. Cruise Control, ABS, Traction Control">
     </div>
     <div class="col-md-6">
         <label>Grip Type</label>
         <select name="grip_type" class="form-select">
             <option value="">Select</option>
             <option value="Rubber">Rubber</option>
             <option value="Foam">Foam</option>
             <option value="Leather">Leather</option>
             <option value="Heated Grip">Heated Grip</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Switch Assembly Type</label>
         <select name="switch_type" class="form-select">
             <option value="">Select</option>
             <option value="OEM Standard">OEM Standard</option>
             <option value="Aftermarket">Aftermarket</option>
             <option value="Integrated Control Unit">Integrated Control Unit</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Lever Material</label>
         <select name="lever_material" class="form-select">
             <option value="">Select</option>
             <option value="Aluminum">Aluminum</option>
             <option value="Steel">Steel</option>
             <option value="Carbon Fiber">Carbon Fiber</option>
             <option value="Adjustable CNC Alloy">Adjustable CNC Alloy</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Mirror Mount Compatibility</label>
         <select name="mirror_mount" class="form-select">
             <option value="">Select</option>
             <option value="Bar-End">Bar-End</option>
             <option value="Clamp-On">Clamp-On</option>
             <option value="Integrated">Integrated</option>
         </select>
     </div>
 </div>
`;
