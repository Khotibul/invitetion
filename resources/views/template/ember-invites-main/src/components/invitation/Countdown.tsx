import { useEffect, useState } from "react";

export function Countdown({ target }: { target: Date }) {
  const [now, setNow] = useState<number | null>(null);
  useEffect(() => {
    setNow(Date.now());
    const id = setInterval(() => setNow(Date.now()), 1000);
    return () => clearInterval(id);
  }, []);

  const diff = now === null ? target.getTime() - target.getTime() : Math.max(0, target.getTime() - now);
  const d = Math.floor(diff / 86400000);
  const h = Math.floor((diff / 3600000) % 24);
  const m = Math.floor((diff / 60000) % 60);
  const s = Math.floor((diff / 1000) % 60);

  const items = [
    { label: "Hari", value: d },
    { label: "Jam", value: h },
    { label: "Menit", value: m },
    { label: "Detik", value: s },
  ];

  return (
    <div className="grid grid-cols-4 gap-3 md:gap-5 max-w-xl mx-auto">
      {items.map((it) => (
        <div
          key={it.label}
          className="rounded-2xl bg-card/70 backdrop-blur border border-gold/40 px-2 py-4 md:py-6 text-center shadow-soft"
        >
          <div className="font-display text-3xl md:text-5xl text-gold tabular-nums">
            {String(it.value).padStart(2, "0")}
          </div>
          <div className="text-[10px] md:text-xs uppercase tracking-[0.2em] text-muted-foreground mt-1">
            {it.label}
          </div>
        </div>
      ))}
    </div>
  );
}
