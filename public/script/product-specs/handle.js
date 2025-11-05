export const handlebarsSpecs = `
 <h5>Controls & Handlebars</h5>
        <div class="row g-3 mb-2">
            <div class="col-md-6">
                <label>Handlebar Type</label>
                <select name="handlebar_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Standard">Standard</option>
                    <option value="Clip-On">Clip-On</option>
                    <option value="Ape Hanger">Ape Hanger</option>
                    <option value="Drag">Drag</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Control Type</label>
                <select name="control_type" class="form-select">
                    <option value="">Select</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="Electronic">Electronic</option>
                    <option value="Hydraulic">Hydraulic</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Control Features</label>
                <input type="text" name="control_features" class="form-control" placeholder="e.g. Cruise Control, ABS, Traction Control">
            </div>
        </div>
`;
