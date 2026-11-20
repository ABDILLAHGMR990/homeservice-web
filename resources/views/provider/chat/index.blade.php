@extends('layouts.provider')

@section('title', 'Pesan')

@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Pesan</h1>
    <p class="page-subtitle">Komunikasi dengan pelanggan Anda</p>
</div>

<div class="hs-card overflow-hidden" style="height:calc(100vh - 220px);min-height:500px;">
    <div class="d-flex h-100">

        {{-- Thread List --}}
        <div class="chat-sidebar" style="width:300px;border-right:1px solid #E5E9EF;overflow-y:auto;flex-shrink:0;">
            <div class="p-3 border-bottom" style="border-color:#E5E9EF;">
                <div class="hs-search-wrap">
                    <i class="bi bi-search hs-search-icon"></i>
                    <input type="text" class="hs-input hs-input-search" placeholder="Cari percakapan...">
                </div>
            </div>

            @forelse($threads ?? [] as $thread)
            <div class="chat-thread-item {{ $loop->first ? 'active' : '' }}"
                 data-booking="{{ $thread->booking_id }}"
                 data-user="{{ $thread->customer_id }}">
                <div class="d-flex align-items-start gap-3">
                    <div class="hs-avatar-sm flex-shrink-0">
                        {{ substr($thread->customerName ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <span class="fw-medium text-truncate" style="color:#202938;font-size:14px;">
                                {{ $thread->customerName ?? 'Pelanggan' }}
                            </span>
                            <span class="small flex-shrink-0 ms-2" style="color:#687386;font-size:11px;">
                                {{ $thread->lastMessageTime ?? '' }}
                            </span>
                        </div>
                        <div class="text-truncate small" style="color:#687386;">
                            {{ $thread->lastMessage ?? 'Belum ada pesan' }}
                        </div>
                        @if(($thread->unreadCount ?? 0) > 0)
                            <span class="chat-unread-badge">{{ $thread->unreadCount }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            {{-- Demo threads --}}
            @foreach([
                ['name'=>'Budi Santoso','last'=>'Baik pak, terima kasih','time'=>'10:30','booking'=>'HS-2026-0001','unread'=>0],
                ['name'=>'Siti Rahayu','last'=>'Pak teknisi sudah sampai?','time'=>'09:15','booking'=>'HS-2026-0002','unread'=>2],
                ['name'=>'Ahmad Fauzi','last'=>'Oke, saya tunggu ya','time'=>'Kemarin','booking'=>'HS-2026-0003','unread'=>0],
            ] as $i => $demo)
            <div class="chat-thread-item {{ $i === 0 ? 'chat-thread-active' : '' }}"
                 onclick="loadChat(this, '{{ $demo['booking'] }}')"
                 style="cursor:pointer;">
                <div class="d-flex align-items-start gap-3">
                    <div class="hs-avatar-sm flex-shrink-0" style="background:#142B49;color:#fff;">
                        {{ substr($demo['name'], 0, 1) }}
                    </div>
                    <div style="flex:1;overflow:hidden;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <span class="fw-medium text-truncate" style="color:#202938;font-size:14px;">{{ $demo['name'] }}</span>
                            <span class="flex-shrink-0 ms-2" style="color:#687386;font-size:11px;">{{ $demo['time'] }}</span>
                        </div>
                        <div class="text-truncate" style="color:#687386;font-size:13px;">{{ $demo['last'] }}</div>
                        @if($demo['unread'] > 0)
                            <span style="display:inline-block;background:#DC4444;color:#fff;border-radius:9999px;font-size:10px;padding:1px 7px;margin-top:3px;">
                                {{ $demo['unread'] }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>

        {{-- Chat Area --}}
        <div class="d-flex flex-column" style="flex:1;overflow:hidden;">

            {{-- Chat Header --}}
            <div class="d-flex align-items-center gap-3 px-4 py-3 border-bottom" style="border-color:#E5E9EF;background:#fff;">
                <div class="hs-avatar-sm" style="background:#142B49;color:#fff;">B</div>
                <div>
                    <div class="fw-semibold" style="color:#202938;font-size:15px;">Budi Santoso</div>
                    <div class="small" style="color:#687386;">
                        <i class="bi bi-receipt me-1"></i>Pesanan HS-2026-0001 · Servis AC
                    </div>
                </div>
                <div class="ms-auto">
                    <a href="{{ route('provider.bookings.show', ['booking_code' => 'HS-2026-0001']) }}"
                       class="hs-btn hs-btn-sm hs-btn-outline-primary">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Pesanan
                    </a>
                </div>
            </div>

            {{-- Messages --}}
            <div class="chat-messages-area p-4" id="chatMessages"
                 style="flex:1;overflow-y:auto;background:#F7F8FA;">

                {{-- Date separator --}}
                <div class="chat-date-sep"><span>Hari ini</span></div>

                {{-- Demo messages --}}
                <div class="chat-bubble-wrap chat-bubble-left">
                    <div class="hs-avatar-xs flex-shrink-0" style="background:#142B49;color:#fff;">B</div>
                    <div>
                        <div class="chat-bubble chat-bubble-incoming">
                            Pak, jadwal servis AC-nya hari ini jam berapa ya?
                        </div>
                        <div class="chat-time">09:00</div>
                    </div>
                </div>

                <div class="chat-bubble-wrap chat-bubble-right">
                    <div>
                        <div class="chat-bubble chat-bubble-outgoing">
                            Halo Pak Budi, jadwalnya jam 10 pagi. Saya akan berangkat dari rumah sekitar jam 09:30 ya.
                        </div>
                        <div class="chat-time text-end">09:05</div>
                    </div>
                </div>

                <div class="chat-bubble-wrap chat-bubble-left">
                    <div class="hs-avatar-xs flex-shrink-0" style="background:#142B49;color:#fff;">B</div>
                    <div>
                        <div class="chat-bubble chat-bubble-incoming">
                            Baik pak, terima kasih. Ditunggu ya 🙏
                        </div>
                        <div class="chat-time">10:30</div>
                    </div>
                </div>
            </div>

            {{-- Message Input --}}
            <div class="p-3 border-top" style="border-color:#E5E9EF;background:#fff;">
                <form id="chatForm" class="d-flex gap-2 align-items-end">
                    @csrf
                    <div style="flex:1;">
                        <textarea id="chatInput" class="hs-textarea"
                                  placeholder="Ketik pesan..."
                                  rows="1"
                                  style="resize:none;min-height:42px;max-height:120px;border-radius:12px;"
                                  onkeydown="handleChatKey(event)"></textarea>
                    </div>
                    <button type="submit" class="hs-btn hs-btn-primary" style="border-radius:10px;padding:10px 16px;">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </form>
                <div class="small mt-1" style="color:#687386;">
                    <i class="bi bi-info-circle me-1"></i>Tekan Enter untuk kirim, Shift+Enter untuk baris baru
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-thread-item { padding:12px 16px; border-bottom:1px solid #F0F2F5; transition:background 0.15s; }
.chat-thread-item:hover, .chat-thread-active { background:#F0F4FF; }
.chat-date-sep { text-align:center; margin:12px 0; position:relative; }
.chat-date-sep::before { content:''; position:absolute; top:50%; left:0; right:0; height:1px; background:#E5E9EF; }
.chat-date-sep span { position:relative; background:#F7F8FA; padding:0 12px; font-size:12px; color:#687386; }
.chat-bubble-wrap { display:flex; gap:8px; margin-bottom:16px; align-items:flex-end; }
.chat-bubble-right { flex-direction:row-reverse; }
.hs-avatar-xs { width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:600; flex-shrink:0; }
.chat-bubble { padding:10px 14px; border-radius:16px; max-width:65%; font-size:14px; line-height:1.5; }
.chat-bubble-incoming { background:#fff; color:#202938; border-bottom-left-radius:4px; box-shadow:0 1px 2px rgba(0,0,0,0.06); }
.chat-bubble-outgoing { background:#142B49; color:#fff; border-bottom-right-radius:4px; }
.chat-time { font-size:11px; color:#9DA7B4; margin-top:4px; }
</style>
@endsection

@push('scripts')
<script>
function handleChatKey(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('chatForm').dispatchEvent(new Event('submit'));
    }
}

document.getElementById('chatForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const input = document.getElementById('chatInput');
    const msg = input.value.trim();
    if (!msg) return;

    // Append bubble (UI only — real implementation uses AJAX/Reverb)
    const container = document.getElementById('chatMessages');
    const wrap = document.createElement('div');
    wrap.className = 'chat-bubble-wrap chat-bubble-right';
    wrap.innerHTML = `
        <div>
            <div class="chat-bubble chat-bubble-outgoing">${msg.replace(/</g,'&lt;')}</div>
            <div class="chat-time text-end">${new Date().toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'})}</div>
        </div>`;
    container.appendChild(wrap);
    container.scrollTop = container.scrollHeight;

    input.value = '';
    input.style.height = 'auto';
});

// Auto-resize textarea
document.getElementById('chatInput').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});

// Scroll to bottom on load
document.getElementById('chatMessages').scrollTop = document.getElementById('chatMessages').scrollHeight;
</script>
@endpush
