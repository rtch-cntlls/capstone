export const exhaustSpecs = `
<div class="row g-3 mb-3">

    <!-- PRODUCT TYPE -->
    <div class="col-md-6">
        <label>Product Type</label>
        <select name="product_type" class="form-select">
            <option value="">Select</option>
            <option value="Slip-On Muffler">Slip-On Muffler</option>
            <option value="Full Exhaust System">Full Exhaust System</option>
            <option value="Header / Manifold">Header / Manifold</option>
            <option value="Exhaust Tip / End Cap">Exhaust Tip / End Cap</option>
            <option value="Heat Shield / Guard">Heat Shield / Guard</option>
            <option value="Baffle / DB Killer">Baffle / DB Killer</option>
            <option value="Catalytic Converter / Emission Part">Catalytic Converter / Emission Part</option>
            <option value="Performance / Racing Kit">Performance / Racing Kit</option>
            <option value="Other Exhaust Component">Other Exhaust Component</option>
        </select>
    </div>

    <!-- DIMENSIONS / SIZE -->
    <div class="col-md-6">
        <label>Pipe Diameter / Dimensions</label>
        <input type="text" name="dimensions" class="form-control" placeholder="e.g. 45mm, 1000mm length">
    </div>

    <!-- SOUND / PERFORMANCE -->
    <div class="col-md-6">
        <label>Sound Level / dB</label>
        <input type="text" name="sound_level" class="form-control" placeholder="e.g. 85 dB, 100+ dB">
    </div>

    <div class="col-md-6">
        <label>Exhaust Note / Performance</label>
        <input type="text" name="performance_note" class="form-control" placeholder="e.g. Racing Tone, Mild Throaty Sound, Sport Tuned">
    </div>

    <!-- CONFIGURATION -->
    <div class="col-md-6">
        <label>System / Header Configuration</label>
        <select name="configuration" class="form-select">
            <option value="">Select</option>
            <option value="1-into-1">1-into-1</option>
            <option value="2-into-1">2-into-1</option>
            <option value="2-into-2">2-into-2</option>
            <option value="3-into-1">3-into-1</option>
            <option value="4-into-1">4-into-1</option>
            <option value="Custom / Universal">Custom / Universal</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Exhaust Tip Style</label>
        <select name="tip_style" class="form-select">
            <option value="">Select</option>
            <option value="Round">Round</option>
            <option value="Slash Cut">Slash Cut</option>
            <option value="Turn Down">Turn Down</option>
            <option value="Dual Outlet">Dual Outlet</option>
            <option value="Upswept / Underbelly">Upswept / Underbelly</option>
            <option value="Custom Shape">Custom Shape</option>
        </select>
    </div>

    <!-- MOUNTING / INSTALLATION -->
    <div class="col-md-6">
        <label>Mounting / Fit Type</label>
        <select name="mounting_type" class="form-select">
            <option value="">Select</option>
            <option value="Side Mount">Side Mount</option>
            <option value="Underbelly / Low Mount">Underbelly / Low Mount</option>
            <option value="High Mount">High Mount</option>
            <option value="Universal Fit">Universal Fit</option>
            <option value="Custom Fit">Custom Fit</option>
        </select>
    </div>

</div>
`;
