import { motion } from "framer-motion";
import type { ReactNode } from "react";

export function SectionTitle({
  eyebrow,
  title,
  children,
}: {
  eyebrow?: string;
  title: string;
  children?: ReactNode;
}) {
  return (
    <motion.div
      initial={{ opacity: 0, y: 24 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true, margin: "-80px" }}
      transition={{ duration: 0.8, ease: "easeOut" }}
      className="text-center max-w-2xl mx-auto"
    >
      {eyebrow && (
        <p className="text-xs uppercase tracking-[0.35em] text-gold mb-3">{eyebrow}</p>
      )}
      <h2 className="font-script text-5xl md:text-6xl text-foreground mb-4">{title}</h2>
      {children && <p className="text-muted-foreground leading-relaxed">{children}</p>}
    </motion.div>
  );
}
