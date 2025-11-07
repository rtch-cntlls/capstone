export const lubricantsSpecs = `
<h5 class="fw-bold">Lubricants & Fluids</h5>
<div class="row g-3 mb-2">

    <!-- Engine & Transmission Lubricants -->
    <div class="col-md-6">
        <label>Engine Oil Type</label>
        <select name="engine_oil_type" class="form-select">
            <option value="">Select</option>
            <option value="Mineral">Mineral</option>
            <option value="Semi-Synthetic">Semi-Synthetic</option>
            <option value="Fully Synthetic">Fully Synthetic</option>
            <option value="Racing / Ester-Based">Racing / Ester-Based</option>
            <option value="4-Stroke Specific">4-Stroke Specific</option>
            <option value="2-Stroke Premix Oil (TCW-3)">2-Stroke Premix Oil (TCW-3)</option>
            <option value="2-Stroke Injection Oil">2-Stroke Injection Oil</option>
            <option value="Scooter/CVT Specific (MB)">Scooter/CVT Specific (MB)</option>
            <option value="High Mileage/Vintage">High Mileage/Vintage</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Engine Oil Viscosity (SAE)</label>
        <select name="engine_oil_viscosity" class="form-select">
            <option value="">Select</option>
            <option value="5W-30">5W-30</option>
            <option value="10W-30">10W-30</option>
            <option value="5W-40">5W-40</option>
            <option value="10W-40">10W-40</option>
            <option value="15W-40">15W-40</option>
            <option value="10W-50">10W-50</option>
            <option value="15W-50">15W-50</option>
            <option value="20W-40">20W-40</option>
            <option value="20W-50">20W-50</option>
            <option value="Single Grade SAE 40/50">Single Grade SAE 40/50</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Oil Standard (API / JASO)</label>
        <select name="oil_standard" class="form-select">
            <option value="">Select</option>
            <option value="API SL">API SL</option>
            <option value="API SM">API SM</option>
            <option value="API SN">API SN</option>
            <option value="API SP">API SP</option>
            <option value="JASO MA">JASO MA</option>
            <option value="JASO MA2">JASO MA2</option>
            <option value="JASO MB">JASO MB</option>
            <option value="JASO FC / FD">JASO FC / FD</option>
            <option value="ACEA">ACEA</option>
            <option value="Manufacturer Specific Spec">Manufacturer Specific Spec</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Transmission / Gear Oil</label>
        <select name="transmission_oil_type" class="form-select">
            <option value="">Select</option>
            <option value="Scooter Gear Oil (Hypoid)">Scooter Gear Oil (Hypoid)</option>
            <option value="SAE 80W-90">SAE 80W-90</option>
            <option value="SAE 75W-90">SAE 75W-90</option>
            <option value="SAE 10W-40">SAE 10W-40</option>
            <option value="ATF">ATF</option>
            <option value="Specific OEM Gear Oil">Specific OEM Gear Oil</option>
            <option value="Shaft Drive Specific Oil">Shaft Drive Specific Oil</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Grease / Bearing Lubricant Type</label>
        <select name="grease_type" class="form-select">
            <option value="">Select</option>
            <option value="Multi-Purpose Lithium Grease">Multi-Purpose Lithium Grease</option>
            <option value="Molybdenum Disulfide Grease">Molybdenum Disulfide Grease</option>
            <option value="High Temperature Bearing Grease">High Temperature Bearing Grease</option>
            <option value="Water-Resistant Marine Grease">Water-Resistant Marine Grease</option>
            <option value="Dielectric Grease">Dielectric Grease</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Chain Lubricant Type</label>
        <select name="chain_lube_type" class="form-select">
            <option value="">Select</option>
            <option value="Chain Wax">Chain Wax</option>
            <option value="Wet Lube / Oil">Wet Lube / Oil</option>
            <option value="Dry Lube / Spray">Dry Lube / Spray</option>
            <option value="O-Ring Safe">O-Ring Safe</option>
            <option value="Racing / High Tack">Racing / High Tack</option>
            <option value="Chain Cleaner / Degreaser">Chain Cleaner / Degreaser</option>
            <option value="All-Weather / Water Resistant">All-Weather / Water Resistant</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- Suspension & Hydraulic Fluids -->
    <div class="col-md-6">
        <label>Fork / Suspension Oil Weight</label>
        <select name="fork_oil_type" class="form-select">
            <option value="">Select</option>
            <option value="2.5W">2.5W</option>
            <option value="5W">5W</option>
            <option value="7.5W">7.5W</option>
            <option value="10W">10W</option>
            <option value="15W">15W</option>
            <option value="20W">20W</option>
            <option value="Hydraulic Fluid / Special">Hydraulic Fluid / Special</option>
            <option value="Synthetic Suspension Oil">Synthetic Suspension Oil</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Brake Fluid Type</label>
        <select name="brake_fluid_type" class="form-select">
            <option value="">Select</option>
            <option value="DOT 3">DOT 3</option>
            <option value="DOT 4">DOT 4</option>
            <option value="DOT 5.1">DOT 5.1</option>
            <option value="DOT 5">DOT 5</option>
            <option value="Mineral Oil">Mineral Oil</option>
            <option value="Racing Brake Fluid">Racing Brake Fluid</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Clutch Fluid Type</label>
        <select name="clutch_fluid_type" class="form-select">
            <option value="">Select</option>
            <option value="DOT 4">DOT 4</option>
            <option value="DOT 5.1">DOT 5.1</option>
            <option value="Mineral Oil">Mineral Oil</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Coolant / Antifreeze Type</label>
        <select name="coolant_type" class="form-select">
            <option value="">Select</option>
            <option value="Ethylene Glycol (EG) Green">Ethylene Glycol (EG) Green</option>
            <option value="Propylene Glycol (PG)">Propylene Glycol (PG)</option>
            <option value="Silicate-Free (OAT/HOAT)">Silicate-Free (OAT/HOAT)</option>
            <option value="Premixed (50/50)">Premixed (50/50)</option>
            <option value="Concentrate">Concentrate</option>
            <option value="Water Wetter / Additive">Water Wetter / Additive</option>
            <option value="Distilled Water Only">Distilled Water Only</option>
            <option value="Long-Life Coolant (LLC)">Long-Life Coolant (LLC)</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Radiator Additive / Coolant Enhancer</label>
        <select name="radiator_additive" class="form-select">
            <option value="">Select</option>
            <option value="Anti-Rust Additive">Anti-Rust Additive</option>
            <option value="Water Wetter / Heat Transfer Enhancer">Water Wetter / Heat Transfer Enhancer</option>
            <option value="Sealant / Stop Leak Additive">Sealant / Stop Leak Additive</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <!-- Additives & Misc -->
    <div class="col-md-6">
        <label>Fuel System Cleaner / Additive</label>
        <select name="fuel_system_additive" class="form-select">
            <option value="">Select</option>
            <option value="Fuel Injector Cleaner">Fuel Injector Cleaner</option>
            <option value="Carburetor Cleaner">Carburetor Cleaner</option>
            <option value="Fuel Stabilizer">Fuel Stabilizer</option>
            <option value="Octane Booster">Octane Booster</option>
            <option value="Ethanol Treatment / Moisture Guard">Ethanol Treatment / Moisture Guard</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Other Fluids / Additives</label>
        <input type="text" name="other_fluids" class="form-control" placeholder="e.g. Oil additive, gasket sealant, contact cleaner">
    </div>

    <div class="col-md-6">
        <label>Quantity / Capacity</label>
        <input type="text" name="fluids_capacity" class="form-control" placeholder="Liters or ml (e.g. 1L engine oil, 150ml gear oil)">
    </div>

</div>
`;
