import { defineConfig } from 'astro/config'
import netlify from '@astrojs/netlify'

// https://astro.build/config
export default defineConfig({
  adapter: netlify({
    devFeatures: {
      images: true,
      environmentVariables: false,
      edgeFunctions: false,
    },
  }),
  // vite: {
  //   css: {
  //     transformer: 'lightningcss',
  //   },
  // },
})
