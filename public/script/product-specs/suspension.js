export const suspensionSpecs = `
<h5>Suspension & Steering</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Front Suspension</label>
                <select name="front_suspension" class="form-select">
                    <option value="">Select</option>
                    <option value="Telescopic Fork">Telescopic Fork</option>
                    <option value="Upside Down Fork">Upside Down Fork</option>
                    <option value="Spring">Spring</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Rear Suspension</label>
                <select name="rear_suspension" class="form-select">
                    <option value="">Select</option>
                    <option value="Twin Shock">Twin Shock</option>
                    <option value="Monoshock">Monoshock</option>
                    <option value="Air Suspension">Air Suspension</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Steering Type</label>
                <select name="steering_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Standard">Standard</option>
                    <option value="Adjustable">Adjustable</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Steering Bearings</label>
                <input type="text" name="steering_bearings" class="form-control" placeholder="e.g. Tapered, Sealed">
            </div>
        </div>
`;
