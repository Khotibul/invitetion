import { motion } from "framer-motion";
import { Heart, Mail } from "lucide-react";
import heroFloral from "@/assets/hero-floral.jpg";

export function Cover({ onOpen, names, date }: { onOpen: () => void; names: string; date: string }) {
  return (
    <section className="fixed inset-0 z-50 bg-gradient-cream overflow-hidden">
      <div
        className="absolute inset-0 opacity-60 mix-blend-multiply"
        style={{
          backgroundImage: `url(${heroFloral})`,
          backgroundSize: "cover",
          backgroundPosition: "center",
        }}
      />
      <div className="absolute inset-0 bg-gradient-to-b from-cream/40 via-transparent to-cream/90" />

      <div className="relative h-full flex flex-col items-center justify-center px-6 text-center">
        <motion.div
          initial={{ opacity: 0, y: -20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 1, delay: 0.2 }}
        >
          <p className="text-xs uppercase tracking-[0.4em] text-gold mb-2">The Wedding Of</p>
          <Heart className="w-5 h-5 text-gold mx-auto" fill="currentColor" />
        </motion.div>

        <motion.h1
          initial={{ opacity: 0, scale: 0.9 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 1.2, delay: 0.4 }}
          className="font-script text-7xl md:text-9xl my-6 leading-none text-foreground"
        >
          {names}
        </motion.h1>

        <motion.p
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 1, delay: 0.9 }}
          className="text-sm md:text-base tracking-[0.3em] uppercase text-muted-foreground mb-10"
        >
          {date}
        </motion.p>

        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 1, delay: 1.1 }}
          className="space-y-3"
        >
          <p className="text-xs uppercase tracking-[0.3em] text-muted-foreground">Kepada Yth.</p>
          <p className="font-display text-2xl md:text-3xl">Bapak / Ibu / Saudara/i</p>
          <p className="text-sm text-muted-foreground italic">Tamu Undangan</p>
        </motion.div>

        <motion.button
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 1, delay: 1.4 }}
          whileHover={{ scale: 1.05 }}
          whileTap={{ scale: 0.96 }}
          onClick={onOpen}
          className="mt-10 inline-flex items-center gap-3 px-8 py-4 rounded-full bg-foreground text-cream shadow-soft hover:shadow-card transition-shadow"
        >
          <Mail className="w-4 h-4" />
          <span className="text-sm tracking-[0.2em] uppercase">Buka Undangan</span>
        </motion.button>
      </div>
    </section>
  );
}
