import { motion } from "framer-motion";
import { Calendar, Clock, MapPin } from "lucide-react";
import { SectionTitle } from "./SectionTitle";
import { Divider } from "./Divider";
import { Countdown } from "./Countdown";
import { useState } from "react";
import { toast } from "sonner";
import couplePhoto from "@/assets/couple-1.jpg";
import gallery1 from "@/assets/gallery-1.jpg";
import gallery2 from "@/assets/gallery-2.jpg";
import gallery3 from "@/assets/gallery-3.jpg";

const eventDate = new Date("2026-08-15T10:00:00+07:00");

const events = [
  {
    title: "Akad Nikah",
    date: "Sabtu, 15 Agustus 2026",
    time: "08.00 - 10.00 WIB",
    place: "Masjid Al-Hikmah, Jakarta Selatan",
  },
  {
    title: "Resepsi",
    date: "Sabtu, 15 Agustus 2026",
    time: "11.00 - 14.00 WIB",
    place: "The Grand Ballroom, Hotel Mulia",
  },
];

const stories = [
  { year: "2019", title: "Pertemuan Pertama", text: "Bertemu di sebuah kafe kecil saat hujan deras, percakapan singkat yang tak terlupakan." },
  { year: "2021", title: "Menjadi Sepasang", text: "Memutuskan untuk berjalan bersama, merangkai mimpi yang sama." },
  { year: "2025", title: "Lamaran", text: "Janji suci diucapkan di hadapan keluarga tercinta." },
  { year: "2026", title: "Hari Bahagia", text: "Mengundang Anda menjadi saksi cinta yang abadi." },
];

export function MainContent() {
  const [rsvp, setRsvp] = useState({ name: "", attendance: "hadir", message: "" });
  const [guests, setGuests] = useState<Array<{ name: string; attendance: string; message: string; at: string }>>([
    { name: "Andi & Keluarga", attendance: "hadir", message: "Selamat menempuh hidup baru! Semoga sakinah, mawaddah, warahmah.", at: "2 jam lalu" },
    { name: "Sarah", attendance: "hadir", message: "Barakallahu lakuma. Tak sabar melihat hari bahagia kalian!", at: "5 jam lalu" },
  ]);

  const submitRsvp = (e: React.FormEvent) => {
    e.preventDefault();
    if (!rsvp.name.trim()) {
      toast.error("Mohon isi nama Anda");
      return;
    }
    setGuests([{ ...rsvp, at: "Baru saja" }, ...guests]);
    setRsvp({ name: "", attendance: "hadir", message: "" });
    toast.success("Terima kasih atas konfirmasi Anda 🤍");
  };

  return (
    <main className="bg-gradient-cream">
      {/* Bismillah / Intro */}
      <section className="relative pt-24 pb-16 px-6 text-center overflow-hidden">
        <p className="text-xs uppercase tracking-[0.4em] text-gold">Bismillahirrahmanirrahim</p>
        <Divider className="my-6" />
        <p className="max-w-2xl mx-auto text-muted-foreground leading-relaxed italic">
          "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri,
          supaya kamu cenderung dan merasa tenteram kepadanya."
        </p>
        <p className="text-xs tracking-widest text-gold mt-3">— Q.S. Ar-Rum: 21</p>
      </section>

      {/* Couple */}
      <section className="py-20 px-6">
        <SectionTitle eyebrow="The Bride & Groom" title="Mempelai">
          Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan pernikahan putra-putri kami.
        </SectionTitle>

        <div className="mt-16 grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">
          {[
            { name: "Anindya Larasati", parents: "Putri dari Bapak Surya & Ibu Diah", initial: "A" },
            { name: "Reyhan Pradipta", parents: "Putra dari Bapak Hadi & Ibu Sinta", initial: "R" },
          ].map((p, i) => (
            <motion.div
              key={p.name}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.8, delay: i * 0.15 }}
              className="rounded-3xl bg-card/80 backdrop-blur border border-border p-8 md:p-10 text-center shadow-card"
            >
              <div className="w-28 h-28 mx-auto rounded-full border-2 border-gold flex items-center justify-center mb-5 bg-secondary">
                <span className="font-script text-6xl text-gold">{p.initial}</span>
              </div>
              <h3 className="font-script text-4xl md:text-5xl mb-2">{p.name}</h3>
              <p className="text-sm text-muted-foreground">{p.parents}</p>
            </motion.div>
          ))}
        </div>
      </section>

      <Divider />

      {/* Countdown */}
      <section className="py-20 px-6">
        <SectionTitle eyebrow="Save The Date" title="Menuju Hari Bahagia" />
        <div className="mt-10">
          <Countdown target={eventDate} />
        </div>
      </section>

      {/* Events */}
      <section className="py-20 px-6 bg-secondary/40">
        <SectionTitle eyebrow="Wedding Events" title="Acara" />
        <div className="mt-14 grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
          {events.map((ev, i) => (
            <motion.div
              key={ev.title}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.7, delay: i * 0.1 }}
              className="rounded-3xl bg-card p-8 border border-border shadow-card"
            >
              <h3 className="font-display text-3xl mb-4 text-center">{ev.title}</h3>
              <div className="h-px bg-gradient-to-r from-transparent via-gold to-transparent mb-5" />
              <ul className="space-y-3 text-sm">
                <li className="flex items-start gap-3"><Calendar className="w-4 h-4 text-gold mt-0.5" /><span>{ev.date}</span></li>
                <li className="flex items-start gap-3"><Clock className="w-4 h-4 text-gold mt-0.5" /><span>{ev.time}</span></li>
                <li className="flex items-start gap-3"><MapPin className="w-4 h-4 text-gold mt-0.5" /><span>{ev.place}</span></li>
              </ul>
              <button className="mt-6 w-full py-3 rounded-full border border-gold text-gold text-xs uppercase tracking-[0.2em] hover:bg-gold hover:text-cream transition-colors">
                Lihat Lokasi
              </button>
            </motion.div>
          ))}
        </div>
      </section>

      {/* Love Story */}
      <section className="py-20 px-6">
        <SectionTitle eyebrow="Our Journey" title="Love Story" />
        <div className="mt-14 max-w-3xl mx-auto relative">
          <div className="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-gold to-transparent" />
          {stories.map((s, i) => (
            <motion.div
              key={s.year}
              initial={{ opacity: 0, x: i % 2 === 0 ? -30 : 30 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.7 }}
              className={`relative mb-10 md:w-1/2 ${i % 2 === 0 ? "md:pr-10" : "md:ml-auto md:pl-10"} pl-12 md:pl-0`}
            >
              <div className={`absolute top-2 w-4 h-4 rounded-full bg-gold border-4 border-cream ${i % 2 === 0 ? "left-2 md:-right-2 md:left-auto" : "left-2 md:-left-2"}`} />
              <div className="rounded-2xl bg-card p-6 border border-border shadow-card">
                <p className="text-xs tracking-[0.3em] text-gold uppercase mb-1">{s.year}</p>
                <h4 className="font-display text-2xl mb-2">{s.title}</h4>
                <p className="text-sm text-muted-foreground leading-relaxed">{s.text}</p>
              </div>
            </motion.div>
          ))}
        </div>
      </section>

      {/* Gallery */}
      <section className="py-20 px-6 bg-secondary/40">
        <SectionTitle eyebrow="Captured Moments" title="Galeri" />
        <div className="mt-14 grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 max-w-5xl mx-auto">
          {[couplePhoto, gallery1, gallery2, gallery3].map((src, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, scale: 0.95 }}
              whileInView={{ opacity: 1, scale: 1 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6, delay: i * 0.08 }}
              className={`relative overflow-hidden rounded-2xl shadow-card ${i === 0 ? "row-span-2 col-span-2" : ""}`}
            >
              <img
                src={src}
                alt={`Galeri ${i + 1}`}
                loading="lazy"
                className="w-full h-full object-cover aspect-square hover:scale-110 transition-transform duration-700"
              />
            </motion.div>
          ))}
        </div>
      </section>

      {/* RSVP */}
      <section className="py-20 px-6">
        <SectionTitle eyebrow="Konfirmasi Kehadiran" title="RSVP">
          Mohon kesediaan untuk mengonfirmasi kehadiran Anda di hari bahagia kami.
        </SectionTitle>

        <form onSubmit={submitRsvp} className="mt-12 max-w-xl mx-auto space-y-4">
          <input
            value={rsvp.name}
            onChange={(e) => setRsvp({ ...rsvp, name: e.target.value })}
            placeholder="Nama Anda"
            className="w-full px-5 py-4 rounded-2xl bg-card border border-border focus:border-gold focus:ring-2 focus:ring-gold/30 outline-none transition"
          />
          <div className="grid grid-cols-3 gap-2">
            {[
              { v: "hadir", l: "Hadir" },
              { v: "ragu", l: "Mungkin" },
              { v: "tidak", l: "Tidak Hadir" },
            ].map((o) => (
              <button
                type="button"
                key={o.v}
                onClick={() => setRsvp({ ...rsvp, attendance: o.v })}
                className={`py-3 rounded-2xl text-sm transition border ${
                  rsvp.attendance === o.v
                    ? "bg-foreground text-cream border-foreground"
                    : "bg-card border-border hover:border-gold"
                }`}
              >
                {o.l}
              </button>
            ))}
          </div>
          <textarea
            value={rsvp.message}
            onChange={(e) => setRsvp({ ...rsvp, message: e.target.value })}
            placeholder="Tulis ucapan & doa..."
            rows={4}
            className="w-full px-5 py-4 rounded-2xl bg-card border border-border focus:border-gold focus:ring-2 focus:ring-gold/30 outline-none transition resize-none"
          />
          <button
            type="submit"
            className="w-full py-4 rounded-full bg-foreground text-cream text-sm uppercase tracking-[0.25em] hover:opacity-90 transition shadow-soft"
          >
            Kirim Konfirmasi
          </button>
        </form>

        {/* Guestbook */}
        <div className="mt-16 max-w-2xl mx-auto">
          <h3 className="font-script text-3xl text-center mb-6">Buku Tamu</h3>
          <div className="space-y-3 max-h-96 overflow-y-auto pr-2">
            {guests.map((g, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 10 }}
                animate={{ opacity: 1, y: 0 }}
                className="rounded-2xl bg-card p-5 border border-border"
              >
                <div className="flex items-center justify-between mb-2">
                  <div className="flex items-center gap-3">
                    <div className="w-9 h-9 rounded-full bg-gold/20 flex items-center justify-center text-gold font-display text-lg">
                      {g.name[0]?.toUpperCase()}
                    </div>
                    <span className="font-medium text-sm">{g.name}</span>
                  </div>
                  <span className="text-[10px] uppercase tracking-wider px-2 py-1 rounded-full bg-secondary text-muted-foreground">
                    {g.attendance === "hadir" ? "Hadir" : g.attendance === "ragu" ? "Mungkin" : "Tidak Hadir"}
                  </span>
                </div>
                {g.message && <p className="text-sm text-muted-foreground leading-relaxed">{g.message}</p>}
                <p className="text-[10px] text-muted-foreground/70 mt-2">{g.at}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Closing */}
      <footer className="py-20 px-6 text-center bg-foreground text-cream">
        <Divider className="mb-6 [&_img]:invert" />
        <p className="text-xs uppercase tracking-[0.4em] text-gold-soft mb-4">Wassalamu'alaikum Wr. Wb.</p>
        <h3 className="font-script text-5xl md:text-6xl mb-4">Terima Kasih</h3>
        <p className="max-w-md mx-auto text-sm opacity-80 leading-relaxed">
          Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir
          dan memberikan doa restu.
        </p>
        <p className="mt-10 font-script text-3xl text-gold-soft">Anindya &amp; Reyhan</p>
        <p className="text-[10px] uppercase tracking-[0.3em] mt-10 opacity-50">
          Made with ♡ — Digital Invitation
        </p>
      </footer>
    </main>
  );
}
