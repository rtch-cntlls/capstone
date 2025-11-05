export const bodySpecs = `
<h5>Body & Frame</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Frame Type</label>
                <select name="frame_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Diamond">Diamond</option>
                    <option value="Trellis">Trellis</option>
                    <option value="Perimeter">Perimeter</option>
                    <option value="Backbone">Backbone</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Seat Height (mm)</label>
                <input type="number" name="seat_height" class="form-control" placeholder="mm">
            </div>
            <div class="col-md-6">
                <label>Weight Limit (kg)</label>
                <input type="number" name="weight_limit" class="form-control" placeholder="kg">
            </div>
        </div>
`;
