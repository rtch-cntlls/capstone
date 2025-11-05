import { engineSpecs } from './product-specs/engine.js';
import { transmissionSpecs } from './product-specs/transmission.js';
import { electricalSpecs } from './product-specs/electrical.js';
import { fuelSpecs } from './product-specs/fuel.js';
import { brakingSpecs } from './product-specs/braking.js';
import { wheelSpecs } from './product-specs/wheels.js';
import { exhaustSpecs } from './product-specs/exhaust.js';
import { bodySpecs } from './product-specs/body.js';
import { coolingSpecs } from './product-specs/cooling.js';
import { handlebarsSpecs } from './product-specs/handle.js';
import { accessoriesSpecs } from './product-specs/accessories.js';
import { lubricantsSpecs } from './product-specs/lubricants.js';
import { suspensionSpecs } from './product-specs/suspension.js';

const specs = {
    'Engine Components': engineSpecs,
    'Transmission & Drivetrain': transmissionSpecs,
    'Electrical & Lighting': electricalSpecs,
    'Fuel System': fuelSpecs,
    'Braking System': brakingSpecs,
    'Wheels & Tires': wheelSpecs,
    'Exhaust System': exhaustSpecs,
    'Body & Frame': bodySpecs,
    'Cooling System': coolingSpecs, 
    'Handlebars & Controls': handlebarsSpecs,
    'Accessories & Apparel': accessoriesSpecs,
    'Lubricants & Fluids': lubricantsSpecs,
    'Suspension & Steering': suspensionSpecs,
};

const categorySelect = document.getElementById('category_id');
const specsContainer = document.getElementById('specific-specs');
const productSpecsInput = document.getElementById('product_specs');
const productForm = document.getElementById('productForm');

function updateSpecsInput() {
    const specValues = {};
    specsContainer.querySelectorAll('input, select, textarea').forEach(el => {
        specValues[el.name] = el.value;
    });
    productSpecsInput.value = JSON.stringify(specValues);
}

categorySelect.addEventListener('change', function() {
    const selectedText = categorySelect.options[categorySelect.selectedIndex].text;
    specsContainer.innerHTML = specs[selectedText] || '';

    updateSpecsInput();

    specsContainer.querySelectorAll('input, select, textarea').forEach(el => {
        el.addEventListener('change', updateSpecsInput);
    });
});

productForm.addEventListener('submit', function() {
    updateSpecsInput();
});

