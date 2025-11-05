export const electricalSpecs = `
 <h5>Electrical & Lighting</h5>
 <div class="row g-3 mb-2">
     <div class="col-md-6">
         <label>Voltage</label>
         <select name="voltage" class="form-select">
             <option value="">Select</option>
             <option value="6V">6V</option>
             <option value="12V">12V</option>
             <option value="24V">24V</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Battery Type</label>
         <select name="battery_type" class="form-select">
             <option value="">Select</option>
             <option value="Lead Acid">Lead Acid</option>
             <option value="Lithium Ion">Lithium Ion</option>
             <option value="Gel">Gel</option>
             <option value="Maintenance-Free (MF)">Maintenance-Free (MF)</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Battery Capacity (Ah)</label>
         <input type="number" name="battery_capacity" class="form-control" placeholder="e.g. 5">
     </div>
     <div class="col-md-6">
         <label>Headlight Type</label>
         <select name="headlight_type" class="form-select">
             <option value="">Select</option>
             <option value="Halogen">Halogen</option>
             <option value="LED">LED</option>
             <option value="HID">HID</option>
             <option value="Projector">Projector</option>
             <option value="Laser">Laser</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Taillight Type</label>
         <select name="taillight_type" class="form-select">
             <option value="">Select</option>
             <option value="LED">LED</option>
             <option value="Bulb">Bulb</option>
             <option value="Integrated">Integrated</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Signal Light Type</label>
         <select name="indicator_type" class="form-select">
             <option value="">Select</option>
             <option value="LED">LED</option>
             <option value="Bulb">Bulb</option>
             <option value="Sequential">Sequential</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Stator Output (W)</label>
         <input type="number" name="stator_output" class="form-control" placeholder="e.g. 100">
     </div>
     <div class="col-md-6">
         <label>Regulator/Rectifier Type</label>
         <select name="regulator_type" class="form-select">
             <option value="">Select</option>
             <option value="Single Phase">Single Phase</option>
             <option value="Three Phase">Three Phase</option>
             <option value="MOSFET">MOSFET</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Wiring Harness Type</label>
         <select name="wiring_type" class="form-select">
             <option value="">Select</option>
             <option value="Standard OEM">Standard OEM</option>
             <option value="Aftermarket">Aftermarket</option>
             <option value="Custom">Custom</option>
         </select>
     </div>
     <div class="col-md-6">
         <label>Charging System</label>
         <select name="charging_system" class="form-select">
             <option value="">Select</option>
             <option value="Magneto">Magneto</option>
             <option value="Alternator">Alternator</option>
             <option value="Generator">Generator</option>
         </select>
     </div>
 </div>
`;
