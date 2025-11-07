export const wheelSpecs = `
<h5 class="fw-bold">Wheels & Tires</h5>
<div class="row g-3 mb-2">

    <div class="col-md-6">
        <label>Front Tire Size</label>
        <select name="front_tire_size" class="form-select">
            <option value="">Select</option>
            <option value="2.25-17">2.25-17</option>
            <option value="2.50-17">2.50-17</option>
            <option value="60/100-17">60/100-17</option>
            <option value="70/90-14">70/90-14</option>
            <option value="70/90-17">70/90-17</option>
            <option value="80/90-14">80/90-14</option>
            <option value="80/90-17">80/90-17</option>
            <option value="90/90-14">90/90-14</option>
            <option value="90/90-17">90/90-17</option>
            <option value="100/80-17">100/80-17</option>
            <option value="110/70-13">110/70-13</option>
            <option value="110/70-17">110/70-17</option>
            <option value="120/70-15">120/70-15</option>
            <option value="120/70-17">120/70-17</option>
            <option value="130/70-17">130/70-17</option>
            <option value="130/90-16">130/90-16</option>
            <option value="140/70-17">140/70-17</option>
            <option value="150/70-16">150/70-16</option>
            <option value="160/70-17">160/70-17</option>
            <option value="110/70-17">110/70-17</option>
            <option value="120/60-17">120/60-17</option>
            <option value="120/65-17">120/65-17</option>
            <option value="120/70-17">120/70-17</option>
            <option value="130/70-17">130/70-17</option>
            <option value="130/80-16">130/80-16</option>
            <option value="150/80-16">150/80-16</option>
            <option value="140/90-15">140/90-15</option>
            <option value="90/90-21">90/90-21</option>
            <option value="80/90-21">80/90-21</option>
            <option value="100/90-19">100/90-19</option>
            <option value="110/80-19">110/80-19</option>
            <option value="120/90-18">120/90-18</option>
            <option value="130/80-18">130/80-18</option>
            <option value="18-90/100">18-90/100</option>
            <option value="19-110/80">19-110/80</option>
            <option value="21-80/100">21-80/100</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rear Tire Size</label>
        <select name="rear_tire_size" class="form-select">
            <option value="">Select</option>
            <option value="2.50-17">2.50-17</option>
            <option value="2.75-17">2.75-17</option>
            <option value="60/100-17">60/100-17</option>
            <option value="70/90-14">70/90-14</option>
            <option value="80/90-14">80/90-14</option>
            <option value="80/90-17">80/90-17</option>
            <option value="90/90-14">90/90-14</option>
            <option value="90/90-17">90/90-17</option>
            <option value="100/80-17">100/80-17</option>
            <option value="100/70-17">100/70-17</option>
            <option value="110/70-13">110/70-13</option>
            <option value="110/70-17">110/70-17</option>
            <option value="120/70-15">120/70-15</option>
            <option value="120/70-17">120/70-17</option>
            <option value="130/70-13">130/70-13</option>
            <option value="130/70-17">130/70-17</option>
            <option value="140/70-14">140/70-14</option>
            <option value="140/70-17">140/70-17</option>
            <option value="150/70-16">150/70-16</option>
            <option value="160/60-17">160/60-17</option>
            <option value="170/60-17">170/60-17</option>
            <option value="180/55-17">180/55-17</option>
            <option value="180/70-16">180/70-16</option>
            <option value="200/55-17">200/55-17</option>
            <option value="120/60-17">120/60-17</option>
            <option value="120/65-17">120/65-17</option>
            <option value="130/70-18">130/70-18</option>
            <option value="140/70-18">140/70-18</option>
            <option value="150/60-17">150/60-17</option>
            <option value="150/70-17">150/70-17</option>
            <option value="160/60-17">160/60-17</option>
            <option value="160/70-17">160/70-17</option>
            <option value="180/55-17">180/55-17</option>
            <option value="180/60-17">180/60-17</option>
            <option value="190/50-17">190/50-17</option>
            <option value="190/55-17">190/55-17</option>
            <option value="200/55-17">200/55-17</option>
            <option value="150/80-16">150/80-16</option>
            <option value="160/70-16">160/70-16</option>
            <option value="170/80-15">170/80-15</option>
            <option value="180/70-16">180/70-16</option>
            <option value="80/100-21">80/100-21</option>
            <option value="90/100-21">90/100-21</option>
            <option value="100/90-19">100/90-19</option>
            <option value="110/80-19">110/80-19</option>
            <option value="120/90-18">120/90-18</option>
            <option value="130/80-18">130/80-18</option>
            <option value="140/80-18">140/80-18</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Front Tire Type</label>
        <select name="front_tire_type" class="form-select">
            <option value="">Select</option>
            <option value="Tubeless">Tubeless</option>
            <option value="Tube Type">Tube Type</option>
            <option value="Radial">Radial</option>
            <option value="Bias-Ply">Bias-Ply</option>
            <option value="Commuter/Street">Commuter / Street</option>
            <option value="Scooter/City">Scooter / City Grip</option>
            <option value="Sport/Supersport">Sport / Supersport</option>
            <option value="Sport Touring">Sport Touring</option>
            <option value="Cruiser/V-Twin">Cruiser / V-Twin</option>
            <option value="Dual-Sport">Dual-Sport</option>
            <option value="Off-Road">Off-Road</option>
            <option value="Adventure">Adventure</option>
            <option value="Racing/Slick">Racing / Slick</option>
            <option value="Aftermarket Performance">Aftermarket Performance</option>
            <option value="All-Weather / Rain">All-Weather / Rain</option>
            <option value="Touring / Long-Distance">Touring / Long-Distance</option>
            <option value="Custom / Retro">Custom / Retro</option>
            <option value="Hybrid / Street-Offroad">Hybrid / Street-Offroad</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rear Tire Type</label>
        <select name="rear_tire_type" class="form-select">
            <option value="">Select</option>
            <option value="Tubeless">Tubeless</option>
            <option value="Tube Type">Tube Type</option>
            <option value="Radial">Radial</option>
            <option value="Bias-Ply">Bias-Ply</option>
            <option value="Commuter/Street">Commuter / Street</option>
            <option value="Scooter/City">Scooter / City Grip</option>
            <option value="Sport/Supersport">Sport / Supersport</option>
            <option value="Sport Touring">Sport Touring</option>
            <option value="Cruiser/V-Twin">Cruiser / V-Twin</option>
            <option value="Dual-Sport">Dual-Sport</option>
            <option value="Off-Road">Off-Road</option>
            <option value="Adventure">Adventure</option>
            <option value="Racing/Slick">Racing / Slick</option>
            <option value="Aftermarket Performance">Aftermarket Performance</option>
            <option value="All-Weather / Rain">All-Weather / Rain</option>
            <option value="Touring / Long-Distance">Touring / Long-Distance</option>
            <option value="Custom / Retro">Custom / Retro</option>
            <option value="Hybrid / Street-Offroad">Hybrid / Street-Offroad</option>
            <option value="Enduro">Enduro</option>
            <option value="Motocross">Motocross</option>
            <option value="Scooter Racing">Scooter Racing</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Wheel Type</label>
        <select name="wheel_type" class="form-select">
            <option value="">Select</option>
            <option value="Spoke Wheel">Spoke Wheel</option>
            <option value="Wire Wheel">Wire Wheel</option>
            <option value="Alloy">Alloy</option>
            <option value="Mag">Mag Wheel</option>
            <option value="Aftermarket Alloy">Aftermarket Alloy</option>
            <option value="Forged Aluminum">Forged Aluminum</option>
            <option value="Billet Aluminum">Billet Aluminum</option>
            <option value="Carbon Fiber">Carbon Fiber</option>
            <option value="Racing/Lightweight">Racing / Lightweight</option>
            <option value="Tubeless-Ready Rim">Tubeless-Ready Rim</option>
            <option value="Steel Rim">Steel Rim</option>
            <option value="Split Rim">Split Rim</option>
            <option value="Multi-Spoke Design">Multi-Spoke Alloy</option>
            <option value="Comstar Wheel">Comstar Wheel</option>
            <option value="Flow Formed">Flow Formed Alloy</option>
            <option value="Pressed Steel">Pressed Steel</option>
            <option value="OEM Factory Type">OEM Factory Type</option>
            <option value="Custom Machined">Custom Machined</option>
            <option value="Supermoto Wheel Set">Supermoto Wheel Set</option>
            <option value="Motocross Wheel Set">Motocross Wheel Set</option>
            <option value="Adventure Wheel Set">Adventure Wheel Set</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rim Size Front (inches)</label>
        <select name="front_rim_size" class="form-select">
            <option value="">Select</option>
            <option value="8">8</option>
            <option value="10">10</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="col-md-6">
        <label>Rim Size Rear (inches)</label>
        <select name="rear_rim_size" class="form-select">
            <option value="">Select</option>
            <option value="8">8</option>
            <option value="10">10</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="Other">Other</option>
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
            <option value="Forged Aluminum">Forged Aluminum</option>
            <option value="Steel">Steel</option>
            <option value="Stainless Steel">Stainless Steel</option>
            <option value="Magnesium Alloy">Magnesium Alloy</option>
            <option value="Carbon Fiber">Carbon Fiber</option>
            <option value="Titanium Alloy">Titanium Alloy</option>
            <option value="Billet Aluminum">Billet Aluminum</option>
            <option value="Chromed Steel">Chromed Steel</option>
            <option value="Anodized Aluminum">Anodized Aluminum</option>
            <option value="Powder-Coated Alloy">Powder-Coated Alloy</option>
            <option value="Painted Alloy">Painted Alloy</option>
            <option value="Polished Alloy">Polished Alloy</option>
            <option value="Die-Cast Alloy">Die-Cast Alloy</option>
            <option value="Reinforced Alloy">Reinforced Alloy</option>
            <option value="Hybrid Alloy">Hybrid Alloy</option>
            <option value="Other">Other</option>
        </select>
    </div>
</div>
`;
