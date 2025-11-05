export const wheelSpecs = `
<h5>Wheels & Tires</h5>
<div class="row g-3 mb-2">
    <div class="col-md-6">
        <label>Front Tire Size</label>
        <select name="front_tire_size" class="form-select">
            <option value="">Select</option>
            <option value="70/90-14">70/90-14 (Scooter)</option>
            <option value="80/90-17">80/90-17</option>
            <option value="90/90-17">90/90-17</option>
            <option value="100/80-17">100/80-17</option>
            <option value="110/70-17">110/70-17</option>
            <option value="120/70-17">120/70-17</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rear Tire Size</label>
        <select name="rear_tire_size" class="form-select">
            <option value="">Select</option>
            <option value="80/90-14">80/90-14 (Scooter)</option>
            <option value="100/80-17">100/80-17</option>
            <option value="120/70-17">120/70-17</option>
            <option value="130/70-17">130/70-17</option>
            <option value="140/70-17">140/70-17</option>
            <option value="150/70-17">150/70-17</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Front Tire Type</label>
        <select name="front_tire_type" class="form-select">
            <option value="">Select</option>
            <option value="Tubeless">Tubeless</option>
            <option value="Tube Type">Tube Type</option>
            <option value="Dual-Sport">Dual-Sport</option>
            <option value="Off-Road">Off-Road</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rear Tire Type</label>
        <select name="rear_tire_type" class="form-select">
            <option value="">Select</option>
            <option value="Tubeless">Tubeless</option>
            <option value="Tube Type">Tube Type</option>
            <option value="Dual-Sport">Dual-Sport</option>
            <option value="Off-Road">Off-Road</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Wheel Type</label>
        <select name="wheel_type" class="form-select">
            <option value="">Select</option>
            <option value="Alloy">Alloy</option>
            <option value="Spoke">Spoke</option>
            <option value="Mag">Mag</option>
            <option value="Carbon Fiber">Carbon Fiber</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rim Size Front (inches)</label>
        <select name="front_rim_size" class="form-select">
            <option value="">Select</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rim Size Rear (inches)</label>
        <select name="rear_rim_size" class="form-select">
            <option value="">Select</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Recommended Tire Pressure (Front / Rear)</label>
        <input type="text" name="recommended_tire_pressure" class="form-control" placeholder="e.g. 30 psi / 32 psi">
    </div>

    <div class="col-md-6">
        <label>Rim Material</label>
        <select name="rim_material" class="form-select">
            <option value="">Select</option>
            <option value="Aluminum Alloy">Aluminum Alloy</option>
            <option value="Steel">Steel</option>
            <option value="Magnesium">Magnesium</option>
            <option value="Carbon Fiber">Carbon Fiber</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Tire Brand (Optional)</label>
        <input type="text" name="tire_brand" class="form-control" placeholder="e.g. Pirelli, IRC, Michelin">
    </div>
</div>
`;
