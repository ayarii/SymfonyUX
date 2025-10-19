import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["name", "output"];

    connect() {
        console.log("✅ Contrôleur Stimulus connecté !");
    }

    greet() {
        const name = this.nameTarget.value || "inconnu";
        this.outputTarget.textContent = `Bonjour ${name}`;
    }
}
