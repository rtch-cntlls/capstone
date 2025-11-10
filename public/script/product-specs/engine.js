export const engineSpecs = `
<div class="row g-3 mb-3">

    <!-- PRODUCT TYPE -->
    <div class="col-md-6">
        <label>Product Type</label>
        <select name="product_type" class="form-select">
            <option value="">Select</option>
            <option value="Piston & Rings">Piston & Rings</option>
            <option value="Cylinder / Cylinder Head">Cylinder / Cylinder Head</option>
            <option value="Camshaft / Valve Train">Camshaft / Valve Train</option>
            <option value="Crankshaft / Connecting Rod">Crankshaft / Connecting Rod</option>
            <option value="Clutch Kit / Plates">Clutch Kit / Plates</option>
            <option value="Gasket / Seal Kit">Gasket / Seal Kit</option>
            <option value="Timing Chain / Belt / Sprockets">Timing Chain / Belt / Sprockets</option>
            <option value="ECU / Engine Control Module">ECU / Engine Control Module</option>
            <option value="Fuel System Component">Fuel System Component</option>
            <option value="Oil Pump / Filter / Cooler">Oil Pump / Filter / Cooler</option>
            <option value="Performance / Big Bore Kit">Performance / Big Bore Kit</option>
            <option value="Engine Mounts">Engine Mounts</option>
            <option value="Starter / Ignition Component">Starter / Ignition Component</option>
            <option value="Aftermarket Engine Kit">Aftermarket Engine Kit</option>
            <option value="Other Engine Component">Other Engine Component</option>
        </select>
    </div>

    <!-- BRAND / MANUFACTURER -->
    <div class="col-md-6">
        <label>Brand / Manufacturer</label>
        <input type="text" name="brand" class="form-control" placeholder="e.g. UMA Racing, Takegawa, OEM">
    </div>


    <!-- DIMENSIONS / SPECIFICATIONS -->
    <div class="col-md-6">
        <label>Dimensions / Size</label>
        <input type="text" name="dimensions" class="form-control" placeholder="e.g. 58mm Bore, 10.5:1 Compression, 120cc">
    </div>

    <!-- PERFORMANCE SPECIFICATIONS -->
    <div class="col-md-6">
        <label>Power / Torque Enhancement</label>
        <input type="text" name="performance_output" class="form-control" placeholder="e.g. +5 HP, Racing Spec, Stock Replacement">
    </div>

    <div class="col-md-6">
        <label>Engine Type Compatibility</label>
        <select name="engine_compatibility" class="form-select">
            <option value="">Select</option>
            <option value="2-Stroke">2-Stroke</option>
            <option value="4-Stroke">4-Stroke</option>
            <option value="Electric Motor">Electric Motor</option>
            <option value="Hybrid">Hybrid</option>
            <option value="Universal / All Types">Universal / All Types</option>
        </select>
    </div>

    <!-- INSTALLATION / MOUNTING -->
    <div class="col-md-6">
        <label>Mounting / Fit Type</label>
        <select name="mounting_type" class="form-select">
            <option value="">Select</option>
            <option value="Bolt-On / OEM Replacement">Bolt-On / OEM Replacement</option>
            <option value="Universal / Adjustable">Universal / Adjustable</option>
            <option value="Race / Custom Fit">Race / Custom Fit</option>
            <option value="Other">Other</option>
        </select>
    </div>

</div>
`;
