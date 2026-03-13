<template>
  <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-6 font-sans">
    <div class="relative w-full max-w-3xl max-h-[90vh] overflow-auto">
      <div class="absolute -inset-0.5 bg-linear-to-r from-cyan-500 via-blue-500 to-cyan-500 rounded-lg blur opacity-30"></div>
      
      <div class="relative bg-linear-to-br from-[#0f1729] to-[#1a2235] rounded-lg shadow-2xl border border-cyan-500/20">
        
        <div class="flex items-center justify-between p-6 border-b border-cyan-500/20">
          <div>
            <h2 class="text-2xl font-bold bg-linear-to-r from-cyan-300 to-blue-400 bg-clip-text text-transparent">
              Ticket Details
            </h2>
            <p class="text-cyan-400 font-mono mt-1">{{ report.ticketId }}</p>
          </div>
          <button
            @click="$emit('close')"
            class="w-10 h-10 bg-cyan-500/10 hover:bg-cyan-500/20 rounded-lg flex items-center justify-center transition-all text-cyan-400 hover:text-cyan-300 shrink-0"
          >
            <XIcon :size="20" />
          </button>
        </div>

        <div class="p-6 space-y-6">
          
          <div class="grid grid-cols-2 gap-4">
            
            <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                <MapPinIcon :size="16" />
                <span class="text-sm">Location</span>
              </div>
              <p class="text-cyan-100 font-semibold">{{ report.location }}</p>
            </div>

            <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                <TargetIcon :size="16" />
                <span class="text-sm">Specific Item</span>
              </div>
              <p class="text-cyan-100 font-semibold">{{ report.specificItem }}</p>
            </div>

            <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                <CalendarIcon :size="16" />
                <span class="text-sm">Submitted Date</span>
              </div>
              <p class="text-cyan-100 font-semibold">
                {{ new Date(report.submittedAt).toLocaleDateString() }}
              </p>
            </div>

            <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                <ClockIcon :size="16" />
                <span class="text-sm">Submitted Time</span>
              </div>
              <p class="text-cyan-100 font-semibold">
                {{ new Date(report.submittedAt).toLocaleTimeString() }}
              </p>
            </div>

          </div>

          <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
            <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
              <TagIcon :size="16" />
              <span class="text-sm">Issue Type</span>
            </div>
            <p class="text-cyan-100 font-semibold">{{ report.issueType }}</p>
          </div>

          <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
            <div class="flex items-center gap-2 text-cyan-200/60 mb-3">
              <FileTextIcon :size="16" />
              <span class="text-sm">Description</span>
            </div>
            <p class="text-cyan-100 leading-relaxed">{{ report.description }}</p>
          </div>

          <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
            <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
              <UserIcon :size="16" />
              <span class="text-sm">Submitted By</span>
            </div>
            <p class="text-cyan-100 font-semibold">{{ report.submittedBy }}</p>
          </div>

          <div class="border-t border-cyan-500/20 pt-6 space-y-4">
            <h3 class="text-lg font-semibold text-cyan-100 mb-4">Update Ticket</h3>
            
            <div class="grid grid-cols-2 gap-4">
              
              <div>
                <label class="block text-cyan-100 mb-3">Priority</label>
                <div class="space-y-2">
                  <label
                    v-for="p in prioritiesList"
                    :key="p.value"
                    class="flex items-center p-3 bg-[#0a0e1a]/50 border border-cyan-500/30 rounded-lg cursor-pointer hover:border-cyan-400/50 transition-all"
                  >
                    <input
                      type="radio"
                      name="priority"
                      :value="p.value"
                      v-model="selectedPriority"
                      class="w-4 h-4 shrink-0 text-cyan-400 bg-[#0a0e1a] border-cyan-500/50"
                    />
                    <span class="ml-3 text-cyan-100">{{ p.label }}</span>
                  </label>
                </div>
              </div>

              <div>
                <label class="block text-cyan-100 mb-3">Status</label>
                <div class="space-y-2">
                  <label
                    v-for="s in statusList"
                    :key="s.value"
                    class="flex items-center p-3 bg-[#0a0e1a]/50 border border-cyan-500/30 rounded-lg cursor-pointer hover:border-cyan-400/50 transition-all"
                  >
                    <input
                      type="radio"
                      name="status"
                      :value="s.value"
                      v-model="selectedStatus"
                      class="w-4 h-4 shrink-0 text-cyan-400 bg-[#0a0e1a] border-cyan-500/50"
                    />
                    <span class="ml-3 text-cyan-100">{{ s.label }}</span>
                  </label>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="flex gap-3 p-6 border-t border-cyan-500/20">
          <button
            @click="handleSave"
            class="flex-1 py-3 bg-linear-to-r from-cyan-500 to-blue-500 text-white rounded-lg hover:from-cyan-400 hover:to-blue-400 transition-all shadow-lg shadow-cyan-500/30 font-semibold"
          >
            Save Changes
          </button>
          <button
            @click="$emit('close')"
            class="px-6 py-3 bg-[#0a0e1a]/50 border border-cyan-500/30 text-cyan-300 rounded-lg hover:bg-cyan-500/10 transition-all font-semibold"
          >
            Cancel
          </button>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
// Import clean icons!
import { X as XIcon, MapPin as MapPinIcon, Target as TargetIcon, Calendar as CalendarIcon, 
         Clock as ClockIcon, Tag as TagIcon, FileText as FileTextIcon, User as UserIcon } from 'lucide-vue-next';
         const isSaving = ref(false);
const props = defineProps({
  report: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close', 'update']);

const selectedPriority = ref(props.report.priority);
const selectedStatus = ref(props.report.status);

const prioritiesList = [
  { value: null, label: 'None (Unassigned)' },
  { value: 'low', label: 'Low' },
  { value: 'normal', label: 'Normal' },
  { value: 'high', label: 'High' }
];

const statusList = [
  { value: 'open', label: 'To Review (Open)' },
  { value: 'in-progress', label: 'In Progress' },
  { value: 'resolved', label: 'Completed (Resolved)' },
  { value: 'rejected', label: 'Rejected' }
];

const handleSave = async () => {
  isSaving.value = true;
  try {
    // We use the raw ID from the report object
    const response = await axios.patch(`http://127.0.0.1:8000/api/admin/tickets/${props.report.id}`, {
      priority: selectedPriority.value,
      status: selectedStatus.value
    });

    emit('update', response.data.report); 
    emit('close');
  } catch (error) {
    console.error("Failed to save:", error);
  } finally {
    isSaving.value = false;
  }
};
</script>