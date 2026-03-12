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
              class="w-10 h-10 bg-cyan-500/10 hover:bg-cyan-500/20 rounded-lg flex items-center justify-center transition-all text-cyan-400 hover:text-cyan-300"
            >
              <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
          </div>
  
          <div class="p-6 space-y-6">
            
            <div class="grid grid-cols-2 gap-4">
              
              <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
                <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                  <span class="text-sm">Location</span>
                </div>
                <p class="text-cyan-100 font-semibold">{{ report.location }}</p>
              </div>
  
              <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
                <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                  <span class="text-sm">Specific Item</span>
                </div>
                <p class="text-cyan-100 font-semibold">{{ report.specificItem }}</p>
              </div>
  
              <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
                <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span class="text-sm">Submitted Date</span>
                </div>
                <p class="text-cyan-100 font-semibold">
                  {{ new Date(report.submittedAt).toLocaleDateString() }}
                </p>
              </div>
  
              <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
                <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                  <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  <span class="text-sm">Submitted Time</span>
                </div>
                <p class="text-cyan-100 font-semibold">
                  {{ new Date(report.submittedAt).toLocaleTimeString() }}
                </p>
              </div>
  
            </div>
  
            <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                <span class="text-sm">Issue Type</span>
              </div>
              <p class="text-cyan-100 font-semibold">{{ report.issueType }}</p>
            </div>
  
            <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-3">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                <span class="text-sm">Description</span>
              </div>
              <p class="text-cyan-100 leading-relaxed">{{ report.description }}</p>
            </div>
  
            <div class="bg-[#0a0e1a]/50 rounded-lg p-4 border border-cyan-500/20">
              <div class="flex items-center gap-2 text-cyan-200/60 mb-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
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
                      :key="p"
                      class="flex items-center p-3 bg-[#0a0e1a]/50 border border-cyan-500/30 rounded-lg cursor-pointer hover:border-cyan-400/50 transition-all"
                    >
                      <input
                        type="radio"
                        name="priority"
                        :value="p"
                        v-model="selectedPriority"
                        class="w-4 h-4 text-cyan-400 bg-[#0a0e1a] border-cyan-500/50"
                      />
                      <span class="ml-3 text-cyan-100 capitalize">{{ p === '' ? 'None' : p }}</span>
                    </label>
                  </div>
                </div>
  
                <div>
                  <label class="block text-cyan-100 mb-3">Status</label>
                  <div class="space-y-2">
                    <label
                      v-for="s in statusList"
                      :key="s"
                      class="flex items-center p-3 bg-[#0a0e1a]/50 border border-cyan-500/30 rounded-lg cursor-pointer hover:border-cyan-400/50 transition-all"
                    >
                      <input
                        type="radio"
                        name="status"
                        :value="s"
                        v-model="selectedStatus"
                        class="w-4 h-4 text-cyan-400 bg-[#0a0e1a] border-cyan-500/50"
                      />
                      <span class="ml-3 text-cyan-100 capitalize">
                        {{ s === 'to-review' ? 'To Review' : s === 'pending' ? 'In Progress' : s }}
                      </span>
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
  
  const props = defineProps({
    report: {
      type: Object,
      required: true
    }
  });
  
  const emit = defineEmits(['close', 'update']);
  
  // Local state for the form, initialized from the prop
  const selectedPriority = ref(props.report.priority);
  const selectedStatus = ref(props.report.status);
  
  // Arrays for our loops
  const prioritiesList = ['low', 'medium', 'high', 'critical', ''];
  const statusList = ['to-review', 'pending', 'rejected', 'completed'];
  
  const handleSave = () => {
    // Emit the updated object back to the parent component
    emit('update', {
      ...props.report,
      priority: selectedPriority.value,
      status: selectedStatus.value,
      assignedTo: selectedStatus.value === 'pending' ? 'Admin User' : props.report.assignedTo,
    });
    
    // Close the modal after saving
    emit('close');
  };
  </script>