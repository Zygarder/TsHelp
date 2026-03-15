<template>
    <div class="report-container">
        <div class="background-effects">
            <div class="blob blob-cyan"></div>
            <div class="blob blob-blue"></div>
        </div>

        <div class="content-wrapper">
            <div class="header-section">
                <router-link to="/dashboard" class="back-link">
                    <svg
                        class="arrow-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Dashboard
                </router-link>

                <div class="title-group">
                    <div class="icon-wrapper red-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect
                                x="2"
                                y="3"
                                width="20"
                                height="14"
                                rx="2"
                                ry="2"
                            ></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-gradient">Report an Issue</h1>
                        <p class="subtitle">
                            Submit a technical support ticket
                        </p>
                    </div>
                </div>
            </div>

            <div class="form-card-wrapper">
                <div class="glow-border"></div>

                <div class="form-card">
                    <form @submit.prevent="handleSubmit" class="issue-form">
                        <div class="form-section">
                            <label class="section-label">
                                Issue Type <span class="required-star">*</span>
                            </label>

                            <div class="radio-group">
                                <label
                                    class="radio-card"
                                    :class="{
                                        active:
                                            formData.issueType ===
                                            'hardware-computer',
                                    }"
                                >
                                    <input
                                        type="radio"
                                        v-model="formData.issueType"
                                        value="hardware-computer"
                                        required
                                        @change="clearSpecificItem"
                                    />
                                    <span class="radio-text"
                                        >Hardware Malfunction - Computer Lab
                                        Unit</span
                                    >
                                </label>

                                <label
                                    class="radio-card"
                                    :class="{
                                        active:
                                            formData.issueType === 'appliance',
                                    }"
                                >
                                    <input
                                        type="radio"
                                        v-model="formData.issueType"
                                        value="appliance"
                                        required
                                        @change="clearSpecificItem"
                                    />
                                    <span class="radio-text"
                                        >Room Appliance (TVs, AC, etc.)</span
                                    >
                                </label>
                            </div>

                            <div v-if="formData.issueType" class="mt-4">
                                <label for="specificItem" class="input-label">
                                    {{
                                        formData.issueType ===
                                        "hardware-computer"
                                            ? "Which PC?"
                                            : "Which Appliance?"
                                    }}
                                    <span class="required-star">*</span>
                                </label>
                                <select
                                    id="specificItem"
                                    v-model="formData.specificItem"
                                    required
                                    class="custom-select"
                                >
                                    <option value="" disabled>Select...</option>

                                    <template
                                        v-if="
                                            formData.issueType ===
                                            'hardware-computer'
                                        "
                                    >
                                        <option
                                            v-for="n in 20"
                                            :key="n"
                                            :value="
                                                'PC-' +
                                                n.toString().padStart(2, '0')
                                            "
                                        >
                                            PC-{{
                                                n.toString().padStart(2, "0")
                                            }}
                                        </option>
                                    </template>

                                    <template v-else>
                                        <option value="tv">TV</option>
                                        <option value="ac">
                                            AC (Air Conditioner)
                                        </option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <div class="form-section">
                            <label for="location" class="section-label">
                                Location <span class="required-star">*</span>
                            </label>
                            <select
                                id="location"
                                v-model="formData.location"
                                required
                                class="custom-select"
                            >
                                <option value="" disabled>
                                    Select a location...
                                </option>

                                <optgroup label="Computer Labs">
                                    <option value="EB-204">EB 204</option>
                                    <option value="EB-205">EB 205</option>
                                    <option value="EB-206">EB 206</option>
                                    <option value="EB-207">EB 207</option>
                                    <option value="EB-208">EB 208</option>
                                    <option value="EB-209">EB 209</option>
                                    <option value="EB-210">EB 210</option>
                                    <option value="EB-309">EB 309</option>
                                    <option value="EB-312">EB 312</option>
                                </optgroup>

                                <optgroup label="Offices">
                                    <option value="SAO-Office">
                                        SAO Office
                                    </option>
                                    <option value="ICT-Office">
                                        ICT Office
                                    </option>
                                    <option value="CEIT-Faculty">
                                        CEIT Faculty
                                    </option>
                                    <option value="Registrar">Registrar</option>
                                    <option value="Library">Library</option>
                                    <option value="CEIT-Dean">
                                        CEIT Dean Office
                                    </option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-section no-border">
                            <label for="description" class="section-label">
                                Please describe the issue in detail
                                <span class="required-star">*</span>
                            </label>
                            <p class="helper-text">
                                Include any relevant information such as error
                                messages, when the issue started, and what you
                                were doing when it occurred.
                            </p>
                            <textarea
                                id="description"
                                v-model="formData.description"
                                required
                                rows="8"
                                class="form-textarea"
                                placeholder="Describe the issue you're experiencing..."
                            ></textarea>
                        </div>

                        <div class="submit-section">
                            <button
                                type="submit"
                                class="submit-button"
                                :disabled="isSubmitting"
                            >
                                <svg
                                    v-if="!isSubmitting"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon
                                        points="22 2 15 22 11 13 2 9 22 2"
                                    ></polygon>
                                </svg>
                                <span v-if="isSubmitting">Submitting...</span>
                                <span v-else>Submit Ticket</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios"; // Don't forget to import axios!

const router = useRouter();

// State for the form
const formData = reactive({
    issueType: "",
    specificItem: "",
    location: "",
    description: "",
});

// Added a loading state so users don't click "Submit" twice!
const isSubmitting = ref(false);

// Clear the specific item when switching between Hardware and Appliance
const clearSpecificItem = () => {
    formData.specificItem = "";
};

const handleSubmit = async () => {
    isSubmitting.value = true;

    try {
        // 1. Map our frontend data to match the Laravel backend requirements
        const payload = {
            issue_category: formData.issueType,
            lab_location: formData.location,
            pc_number: formData.specificItem, // The backend expects 'pc_number', even if it's an appliance!
            description: formData.description,
        };

        // 2. Send it to the client endpoint we just built
        await axios.post("http://127.0.0.1:8000/api/client/tickets", payload);

        // 3. If successful, redirect to the success page
        router.push({
            path: "/success",
            state: { type: "issue" },
        });
    } catch (error) {
        console.error(
            "Error submitting ticket:",
            error.response?.data || error.message
        );
        alert(
            "Something went wrong while submitting your report. Please try again."
        );
    } finally {
        isSubmitting.value = false;
    }
};
</script>

<style scoped>
/* --- Layout & Background --- */
.report-container {
    min-height: 100vh;
    background: linear-gradient(to bottom right, #0a0e1a, #0d1426, #050a1a);
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
    font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
}

.background-effects {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

.blob {
    position: absolute;
    width: 24rem;
    height: 24rem;
    border-radius: 50%;
    filter: blur(64px);
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.blob-cyan {
    top: 25%;
    left: 25%;
    background-color: rgba(6, 182, 212, 0.1);
}
.blob-blue {
    bottom: 25%;
    right: 25%;
    background-color: rgba(59, 130, 246, 0.1);
    animation-delay: 1s;
}

@keyframes pulse {
    0%,
    100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.content-wrapper {
    position: relative;
    max-width: 48rem; /* max-w-3xl */
    margin: 0 auto;
    z-index: 10;
}

/* --- Header --- */
.header-section {
    margin-bottom: 2rem;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #22d3ee;
    text-decoration: none;
    font-size: 0.875rem;
    margin-bottom: 1.5rem;
    transition: color 0.2s;
}
.back-link:hover {
    color: #67e8f9;
}
.arrow-icon {
    width: 1rem;
    height: 1rem;
}

.title-group {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.icon-wrapper {
    width: 3rem;
    height: 3rem;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}
.red-icon {
    background: linear-gradient(to bottom right, #ef4444, #f97316);
    box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.5);
}

.text-gradient {
    font-size: 1.875rem;
    font-weight: 700;
    margin: 0;
    background: linear-gradient(to right, #67e8f9, #60a5fa);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.subtitle {
    color: rgba(165, 243, 252, 0.6);
    margin: 0.25rem 0 0 0;
}

/* --- Form Card --- */
.form-card-wrapper {
    position: relative;
}

.glow-border {
    position: absolute;
    top: -2px;
    right: -2px;
    bottom: -2px;
    left: -2px;
    background: linear-gradient(to right, #06b6d4, #3b82f6, #06b6d4);
    border-radius: 0.6rem;
    filter: blur(8px);
    opacity: 0.2;
    z-index: -1;
}

.form-card {
    background: linear-gradient(to bottom right, #0f1729, #1a2235);
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.2);
}

.issue-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-section {
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(6, 182, 212, 0.2);
}
.no-border {
    border-bottom: none;
    padding-bottom: 0;
}

.section-label {
    display: block;
    font-size: 1.125rem;
    color: #cffafe;
    margin-bottom: 1rem;
}
.required-star {
    color: #f87171;
}

/* --- Radio Buttons --- */
.radio-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.radio-card {
    display: flex;
    align-items: center;
    padding: 1rem;
    background-color: rgba(10, 14, 26, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.3);
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.2s;
}

.radio-card:hover {
    border-color: rgba(34, 211, 238, 0.5);
}
.radio-card.active {
    border-color: #22d3ee;
    background-color: rgba(34, 211, 238, 0.05);
}

.radio-card input[type="radio"] {
    width: 1.25rem;
    height: 1.25rem;
    accent-color: #22d3ee;
    margin: 0;
    cursor: pointer;
}

.radio-text {
    margin-left: 0.75rem;
    color: #cffafe;
    transition: color 0.2s;
}
.radio-card:hover .radio-text {
    color: #67e8f9;
}

/* --- Inputs & Selects --- */
.mt-4 {
    margin-top: 1rem;
}
.input-label {
    display: block;
    color: #cffafe;
    margin-bottom: 0.75rem;
    font-size: 0.875rem;
}

.custom-select,
.form-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    background-color: rgba(10, 14, 26, 0.5);
    border: 1px solid rgba(6, 182, 212, 0.3);
    border-radius: 0.5rem;
    color: #cffafe;
    font-size: 1rem;
    transition: all 0.2s;
    box-sizing: border-box;
    font-family: inherit;
}

.custom-select {
    appearance: none;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2367e8f9' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 1rem center;
    background-repeat: no-repeat;
    background-size: 1.5em;
    padding-right: 2.5rem;
}

.custom-select option,
.custom-select optgroup {
    background-color: #0f1729;
    color: #cffafe;
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
}
.form-textarea::placeholder {
    color: rgba(6, 182, 212, 0.3);
}
.custom-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: #22d3ee;
    box-shadow: 0 0 0 2px rgba(34, 211, 238, 0.2);
}

.helper-text {
    font-size: 0.875rem;
    color: rgba(165, 243, 252, 0.6);
    margin: 0 0 0.75rem 0;
    line-height: 1.4;
}

/* --- Submit Button --- */
.submit-section {
    padding-top: 1.5rem;
}

.submit-button {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(to right, #06b6d4, #3b82f6);
    color: white;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1.125rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    transition: all 0.2s;
    box-shadow: 0 10px 15px -3px rgba(6, 182, 212, 0.3);
}

.submit-button:hover {
    background: linear-gradient(to right, #22d3ee, #60a5fa);
    box-shadow: 0 10px 15px -3px rgba(34, 211, 238, 0.4);
}
</style>
